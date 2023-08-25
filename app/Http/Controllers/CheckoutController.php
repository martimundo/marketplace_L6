<?php

namespace App\Http\Controllers;

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
        

        return view('checkout',compact('cartItens'));
    }

    public function proccess(Request $request)
    {
        $dataPost = $request->all();

        $reference = '';

        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        //informar o email do vendendor
        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));


        $creditCard->setReference($reference);


        $creditCard->setCurrency("BRL");

        //adicionando os itens
        $cartItens = session()->get('cart');
        foreach ($cartItens as $item) {
            $item->addItems()->withParameters(
                $reference,
                $item['name'],
                $item['amount'],
                $item['price']
            );
        }

        //Caso esteja usando o teste em sandbox, usar o seguinte dominio:@sandbox.pagseguro.com.br

        $user = auth()->user();
        $email = env('PAGSEGURO_ENV') === 'sandbox' ? 'teste@sandbox.pagseguro.com.br' : $user->email;

        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);

        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '843.187.110-56'
        );

        $creditCard->setSender()->setHash($dataPost['hash']);

        $creditCard->setSender()->setIp('127.0.0.0');


        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );


        $creditCard->setToken($dataPost['card_token']);

        list($quantity, $installmentAmount) = explode('|', $dataPost['installment']);

        $installmentAmount = number_format($installmentAmount, 2,'.','');

        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($dataPost['card_name']);

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '843.187.110-56'
        );


        $creditCard->setMode('DEFAULT');

        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        var_dump($result);
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
