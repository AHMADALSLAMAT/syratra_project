<?php

namespace App\Helpers;

class AddNewData {
    public static function createData($modelName, $columns, $values) {
        $addNewData = new $modelName();

        foreach ($columns as $key => $column) {
            $addNewData->$column = $values[$key];
        }

        $addNewData->save();
    }
}
