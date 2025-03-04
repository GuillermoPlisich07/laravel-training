<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\OrdenesPaypal;

class PaypalController extends Controller
{
    public function paypal_inicio(){
        $monto = "10";
        $responseToken= Http::withBasicAuth(env('PAYPAL_CLIENT_ID'),env('PAYPAL_SECRET'))
        ->asForm()->post(
                            env('PAYPAL_BASE_URI')."/v1/oauth2/token",
                            [
                                'grant_type'=>'client_credentials'
                            ])
                        ;
        $token = $responseToken->json()['access_token'];
        $orden=OrdenesPaypal::create([
            'token'=>$token,
            'orden'=>'',
            'nombre'=>'',
            'correo'=>'',
            'id_captura'=>'',
            'monto'=>$monto,
            'country_code'=>'',
            'estado'=>0,
            'fecha'=>date('Y-m-d H:i:s'),
            'paypal_request'=>''
        ]);

        $response = Http::withHeaders(
            [
                'Authorization'=>'Bearer '.$token,
                'PayPal-Request-Id'=>$orden->id,
            ]
        )->post(
            env('PAYPAL_BASE_URI')."/v2/checkout/orders",
            [
                'intent'=>'CAPTURE',
                    'purchase_units'=>[
                        0 => [
                            "reference_id"=> "reference_".$orden->id,
                            "amount"=> [
                                "value"=> $monto,
                                "currency_code"=> "USD"
                            ]
                        ]
                    ],
                    "payment_source" => [
                        'paypal' => [
                          "experience_context" => [
                            "payment_method_preference" => "IMMEDIATE_PAYMENT_REQUIRED",
                            "payment_method_selected" => "PAYPAL",
                            "brand_name" => "EXAMPLE",
                            "locale" => "es-ES",
                            "landing_page" => "LOGIN",
                            "shipping_preference" => "NO_SHIPPING",
                            "user_action" => "PAY_NOW",
                            "return_url" => "http://prueba.localhost/paypal/respuesta",
                            "cancel_url" => "http://prueba.localhost/paypal/cancelado"
                          ]
                        ]
                    ],
            ]
        );
        if($response->status()!=200){
            return redirect()->route('paypal.error');
        }
        $orden=OrdenesPaypal::find($orden->id);
        $orden->orden=$response->json()['id'];
        $orden->save();
        return view('paypal.home',compact('orden','response'));
    }

    public function paypal_respuesta(){
        $id = $_GET['token'];
        if($id){
            $orden=OrdenesPaypal::where('orden',$id)->firstOrFail();
            $headers = [
                "Content-Type" => "application/json",
            ];
            $response = Http::withToken($orden->token)->withHeaders($headers)->send('POST', env('PAYPAL_BASE_URI')."/v2/checkout/orders/".$orden->orden."/capture");
            if(isset($response->json()['id'])){
                
                $orden->nombre = $response->json()['payment_source']['paypal']['name']['given_name'].' '.$response->json()['payment_source']['paypal']['name']['surname'];
                $orden->correo = $response->json()['payment_source']['paypal']['email_address'];
                $orden->id_captura = $response->json()['purchase_units'][0]['payments']['captures'][0]['id'];
                $orden->country_code = $response->json()['payment_source']['paypal']['address']['country_code'];
                $orden->estado=1;
                $orden->save();
                $estado = 'ok';

            }else{
                $estado = 'error';
            }
            return view('paypal.respuesta',compact('estado','id'));
        }else{
            $estado = 'error';
            return redirect()->route('paypal.error', compact('estado','id'));
        }
    }

    public function paypal_cancelado()    {
        $id = $_GET['token'];
        $orden = OrdenesPaypal::where('orden',$id)->firstOrFail();
        $orden->estado=2;
        $orden->save();
        return view('paypal.cancelado',compact('id'));
    }

}
