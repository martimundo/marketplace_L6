<?php

namespace App\Http\Controllers;

use App\Payment\PagSerguro\CreditCard;
use App\Store;
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

        $this->makePagSeguroSession();

        //var_dump(session()->get('pagseguro_session_code'));



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

            $userOrder->store()->sync();

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
