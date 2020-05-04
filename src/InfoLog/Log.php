<?php
namespace InfoLog;

use Helper\elsiiHelper;
use Helper\ModelMain;

class Log extends ModelMain
{
    /**
     * Отправка логов
     *
     * @param array $data
     * @param bool $id_project
     * @param string $text_info
     * @return bool
     */
    public static function info($data = [], $id_project = false, $text_info = 'text default')
    {
        elsiiHelper::query('http://185.237.97.53/api/send-info-message', [
            'data' => $data,
            'id_project' => $id_project,
            'text_info' => $text_info,
        ], 'POST');

        return true;
    }
}
