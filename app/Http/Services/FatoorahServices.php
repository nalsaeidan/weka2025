<?php

namespace App\Http\Services;

//use http\Client;
use App\Models\User;
use GuzzleHttp\Client;
//use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request;
class FatoorahServices
{
    private $base_url;
    private $headers;
    private $request_client;
    //private $token="rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL";
    private $token="uyePLNlJCIn7aPTZp2CaTjpSRowNTC38bK-aRemJC9F-_YNvtqDGPwqSBAvZugH1ZaDVuRTa9vwParyd9tl_JjS103Qg7RGABWXfbGaQBUrFi5Ik-WN52vivS-o6pxCUJVbUICKsRrbgVrgZ5MGaY63h38ZCWW5Sq_Kk8deRiFZQtMmec10yeOUhMyDSNYut4WtLcJ--soxjDeuUiMHQXUvLdDSHMwTnmWGyJFbFgZa2ybzJu7L_HjUTGozW-Tkm542wsxljzlyauT41rSaAXm9D1u4Q8qOCOTCZdNr3oKozLUN8t7ZORkE7wO9RDxIEMNlvaVl1kfnB6prbYup_5VFZU58_3t9etwm26BEbRrViVAu96HQ5QrXegFmKajftLuZvOUl5ipWbwH_UULSJRkcyOtDnD7lxPibaNduStGAusEXOsCWqE2m9W7fz0V2TKsujpVBsgqgc0ByjINp0x04UUUd8RxMTxmpOwebgRNVjENOm5W-Rikpn898ibIG7T_mv3Ybw3yf9v0Q3vcpjsYMbsnzlDJHA--Wlr32UvW8utllp9MJgLTCKS2NOi4MTttMpREJB6GXJe_4b5Z-fgD7DgyOx3iD3V20rHqeydsTwBScblRk7OdUA0vcIe9NfJ79A9Jd7GK8Grgx3F7ZCt56h1R9J1Le6u5OhGMipkaciCEPD";
	public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('FATOORAH_BASE_URL');
       // $this->base_url = env('FATOORAH_BASE_URL')??'https://apitest.myfatoorah.com';
        $token=env('FATOORAH_TOKEN');
        $this->headers = [
            "Content-Type" => 'application/json',
            "authorization" => "Bearer " . $token
        ];
    }

    public function buildRequest($uri,$method,$body=[]){

        $request= new Request($method,$this->base_url.$uri,$this->headers);
        if(!$body){
            return false;
        }
        $response=$this->request_client->send($request,[
            'json'=>$body
        ]);
        if($response->getStatusCode() !=200){
            return false;
        }


        $response=json_decode($response->getBody(),true);
        return $response;
    }
    public function buildRequest2($uri,$method,$body=[]){
        $curl = curl_init($this->base_url.$uri);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_POSTFIELDS     => json_encode($body),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $this->token", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error =$this->handleError($response);
        if ($error) {
            die("Error: $error");
        }

        return json_decode($response);
    }
    public function parsePaymentData($user_id,$value,$tax,$currency){
        $user= User::find($user_id);
        $email=($user->email)??filter_var($user->email,FILTER_VALIDATE_EMAIL);
        if($email && $user->email){
            $email=$user->email;
        }
        return [
            'CustomerName'=>$user->name??'Abdallah',
            "NotificationOption"=>"LNK",
            "InvoiceValue"=>$value,
            "InvoiceTax"=>$tax,
            "CustomerEmail"=>$email,
            "CallBackUrl"=>env('fatoorah_success_url'),
            "ErrorUrl"=>env('fatoorah_error_url'),
            "Language"=>"en",
            "DisplayCurrencyIso"=>"USD"

        ];
    }


    public function sendPayment($requestData=[]){
        return $response= $this->buildRequest2('/v2/sendPayment','POST',$requestData);

    }


    public function getPaymentStatus($data){

        return $response= $this->buildRequest2('/v2/getPaymentStatus','POST',$data);

    }

    public function handleError($response) {

        $json = json_decode($response);
        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }

        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }

        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }

        return $error;
    }

}
