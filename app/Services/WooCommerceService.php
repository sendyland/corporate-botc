<?php
namespace App\Services;

use GuzzleHttp\Client;

class WooCommerceService
{
    protected $client;
    protected $storeUrl;
    protected $consumerKey;
    protected $consumerSecret;

    public function __construct($storeUrl, $consumerKey, $consumerSecret)
    {
        $this->storeUrl = $storeUrl;
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;

        $this->client = new Client([
            'base_uri' => $this->storeUrl . '/wp-json/wc/v3/',
            'auth' => [$this->consumerKey, $this->consumerSecret],
        ]);
    }

    public function getProducts()
    {
        $response = $this->client->get('products');
        return json_decode($response->getBody(), true);
    }

    public function createOrder($orderData)
    {
        $response = $this->client->post('orders', [
            'json' => $orderData,
        ]);

        return json_decode($response->getBody(), true);
    }
}
