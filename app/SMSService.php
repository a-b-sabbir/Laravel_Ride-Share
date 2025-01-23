<?php

namespace App;

use Illuminate\Support\Facades\Http;

class SMSService
{

    protected $username;
    protected $password;
    protected $apicode;
    protected $countrycode;
    protected $cli;
    protected $tran_type;
    protected $request_type;
    protected $rn_code;

    public function __construct()
    {
        // Set the Grameenphone credentials (or store in .env)
        $this->username = env('SMS_USERNAME');
        $this->password = env('SMS_PASSWORD');
        $this->apicode = '5'; // For sending SMS with delivery request
        $this->countrycode = '880';
        $this->cli = 'VIDtest33'; // Masking name
        $this->tran_type = 'P'; // Promotional type
        $this->request_type = 'S'; // Single message request
        $this->rn_code = '71'; // GP RN code
    }

    public function sendOTP($phoneNumbers, $message, $clientTransId, $billMsisdn)
    {
        $response = Http::post('https://gpcmp.grameenphone.com/gp/ecmapigw/webresources/ecmapigw.v3', [
            'username' => $this->username,
            'password' => $this->password,
            'apicode' => $this->apicode,
            'msisdn' => $phoneNumbers,
            'countrycode' => $this->countrycode,
            'cli' => $this->cli,
            'messagetype' => '1', // English text
            'message' => $message,
            'clienttransid' => $clientTransId,
            'bill_msisdn' => $billMsisdn,
            'tran_type' => $this->tran_type,
            'request_type' => $this->request_type,
            'rn_code' => $this->rn_code
        ]);

        return $response->json(); // Return the response in JSON format
    }
}
