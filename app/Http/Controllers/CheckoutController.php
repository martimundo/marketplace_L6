<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\Notification;
use App\Payment\PagSerguro\CreditCard;
use App\Store;
use App\UserOrder;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        //session()->forget('pagseguro_session_code');

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!session()->has('cart')) {

            return redirect()->route('home');
        }

        $this->makePagSeguroSession();

        $cartItens = array_map(function ($line) {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItens = array_sum($cartItens);


        return view('checkout', compact('cartItens'));
    }

    public function proccess(Request $request)
    {
        try {
            $dataPost = $request->all();
            $user = auth()->user();
            $cartItens = session()->get('cart');
            $stores = array_unique(array_column($cartItens, 'store_id'));
            $reference = Uuid::uuid4();

            $creditCardPayment = new CreditCard($cartItens, $user, $dataPost, $reference);
            $result = $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItens),

            ];

            $userOrder = $user->orders()->create($userOrder);

            $userOrder->stores()->sync($stores);

            //Notificar loja de novo pedido
            $store = (new Store())->notifyStoreOwners($stores);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso!',
                    'order'   => $reference
                ]
            ]);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? simplexml_load_string($e->getMessage()) : 'Erro ao processar pedido!';

            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }

    public function tanks()
    {
        return view('tanks');
    }

    public function notification()
    {
        try {
            $notification = new Notification();

            $notification = $notification->getTransaction();

            //atualilzando pedido do usuário
            $reference = base64_decode($notification->getReference());
            $userOrder = UserOrder::whereReference($reference);
            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);

            if ($notification->getStatus() == 3) {

                //Liberar o pedido do usuário...atualizar o status do pedido para em separação
                //Notificar o usuário que o pedido foi pago
                //Notificar a loja da compra realizada com sucesso(pago)
            }

            return response()->json([], 204);


            //comentários do pedido pago

        } catch (\Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : [];
            return response()->json(['error'=>$message], 500);
        }
    }

    private function makePagSeguroSession()
    {

        if (!session()->has('pagseguro_session_code')) {

            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
        } else {
            return null;
        }
        return session()->put('pagseguro_session_code', $sessionCode->getResult());
    }
}
