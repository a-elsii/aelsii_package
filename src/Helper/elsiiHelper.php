<?php
/**
 *
 */
namespace Helper;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class elsiiHelper
{
    private $serverApi = 'http://185.237.97.53/api/';
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Функция для отправки запросов
     *
     * @param array $params
     * @param string $method - метод который нам нужен
     * @return mixed
     */
    public function query($params = [], $method = 'GET')
    {
        $params[RequestOptions::SYNCHRONOUS] = true;
        $this->client->requestAsync(
            $method,
            "{$this->serverApi}send-info-message",
            [
                'form_params' => $params,
            ]
        )->wait(false);

        return true;
    }


//    public static function query($url, $params = [], $method = 'GET')
//    {
//        $client = new Client();
//        $response = $client->request($method, $url, ['form_params' => $params,]);
//        $headers = $response->getHeaders();
//        $body = $response->getBody();
//        var_dump($headers, $body);
//    }
}