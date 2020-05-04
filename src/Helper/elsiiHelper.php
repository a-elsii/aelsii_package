<?php
/**
 *
 */
namespace Helper;

use GuzzleHttp\Client;

class elsiiHelper
{
    /**
     * Функция для отправки запросов
     *
     * @param string $url
     * @param array $params
     * @param string $method - метод который нам нужен
     * @return mixed
     */
    public static function query($url, $params = [], $method = 'GET')
    {
        $client = new Client();
        $client->request(
            $method,
            $url,
            [
                'form_params' => $params,
            ]
        );

        return true;
    }

    /**
     * Функция для получения Env
     *
     * @param $key
     * @param null $default
     * @return array|bool|false|string|void|null
     */
    public static function MyEnv($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false)
            return $default;

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (($valueLength = strlen($value)) > 1 && $value[0] === '"' && $value[$valueLength - 1] === '"') {
            return substr($value, 1, -1);
        }

        return $value;
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