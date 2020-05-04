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
        try {
            $model = new elsiiHelper();
            $model->query([
                'data' => $data,
                'id_project' => $id_project,
                'text_info' => $text_info,
            ], 'POST');
        } catch (\Exception $e) {
            return true;
        }

        return true;
    }
}
