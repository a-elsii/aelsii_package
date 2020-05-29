<?php
/**
 *
 */
namespace Helper;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use DateTime;

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


    /**
     * Функция для получения разницы во времени
     *
     * @param $time_start
     * @param $time_end
     * @return \DateInterval|false
     */
    public static function getDateDiff($time_start, $time_end)
    {
        $_date_start = date('Y-m-d H:i:s', $time_start);
        $_date_end = date('Y-m-d H:i:s', $time_end);

        $date_start_create = date_create($_date_start);
        $date_end_create = date_create($_date_end);

        return date_diff($date_start_create, $date_end_create);
    }

    /**
     * Получаем процент от числа
     *
     * @param int $number
     * @param float $percent
     * @return float|int
     */
    public static function getPercentToNumber(int $number,float $percent) {
        return ($number * $percent) / 100;
    }

    /**
     * Функция для убирания бита с числа
     *
     * @param int $result_bit
     * @param int $bit
     * @return int
     */
    public static function softRemBit(int $result_bit,int $bit) {
        // Если бит установлен то мы его снимаем
        if($result_bit & $bit)
            $result_bit ^= $bit;

        return $result_bit;
    }

    /**
     * Функция для установки бита
     *
     * @param int $result_bit
     * @param int $bit
     * @return int
     */
    public static function softSetBit(int $result_bit,int $bit) {
        // Если бит установлен то мы возвращаем биты
        if($result_bit & $bit)
            return $result_bit;

        $result_bit |= $bit;

        return $result_bit;
    }

    /**
     * Функция для получения DateTime
     *
     * @param $timestamp integer
     * @param $format string
     * @return DateTime
     * @throws \Exception
     */
    public static function getDateTime($timestamp, $format = 'Y-m-d H:i:s') {
        return new DateTime(date($format, $timestamp));
    }

    /**
     * Функция которая проверяет вхождения времени
     * мы проверяем время начала работы и окончания если в этот промежуток попадает аренда то мы выводим true иначе false
     * @param $unix_from - время начала работы
     * @param $unix_to - время окончания работы
     * @param $time_start_rent - время начала аренды
     * @param $time_end_rent - время окончания аренды
     * @param $is_debug - дебаг времени
     * @return bool
     */
    public static function checkTimeRent($unix_from, $unix_to, $time_start_rent, $time_end_rent, $is_debug = false) {
        if($is_debug)
            print ("unix_from -> ". date('Y-m-d H:i:s', $unix_from) ." >= start_rent -> ". date('Y-m-d H:i:s', $time_start_rent) ." && unix_to -> ". date('Y-m-d H:i:s', $unix_to) ." <= end_rent -> ". date('Y-m-d H:i:s', $time_end_rent) ."" . PHP_EOL);

        if(
            ($unix_from >= $time_start_rent && $unix_to <= $time_end_rent)
            || ($time_start_rent >= $unix_from && $unix_to <= $time_end_rent && $time_start_rent < $unix_to)
            || ($unix_from >= $time_start_rent && $unix_to >= $time_end_rent && $time_end_rent > $unix_from && $time_end_rent < $unix_to)
        )
            return true;

        return false;
    }
}