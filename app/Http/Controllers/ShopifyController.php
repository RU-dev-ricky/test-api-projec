<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopifyController extends Controller
{
    //
    public function sampleAPI () {
        $endpoint = 'https://api.publicapis.org/entries';
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $endpoint);
        $statusCode = $response->getStatusCode();
        return $result = json_decode($response->getBody(), true);
    }
}
