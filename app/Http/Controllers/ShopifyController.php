<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class ShopifyController extends Controller
{
    //
    public function sampleAPI () {
        $http = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
        try {
            $response = $http->get('https://api.publicapis.org/entries');
            $result = json_decode((string) $response->getBody(), true);
            return $result;
        } catch (RequestException $e) {
            $errors = $e->getResponse();
            return $errors = json_decode((string) $errors->getBody(), true);
        }
    }
}
