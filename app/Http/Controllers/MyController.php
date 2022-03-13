<?php

namespace App\Http\Controllers;

include_once "../database/tools/ColumnComment.php";

use App\Models\MyModels;
use database\tools\ColumnComment;

class MyController extends Controller
{
    public function getCreate(MyModels $model): Response
    {
        $form = new \stdClass();
        $form->columns = $this->getColumns($model);
        $json = json_encode($form, JSON_NUMERIC_CHECK|JSON_PRETTY_PRINT);
        if(!json_last_error()) {
            return new Response(
                $json,
            200,
            );
        }
        return new Response("Error", 500);
    }

    private function getColumns(MyModels $model): array
    {
        $list = [];
        $comm = new ColumnComment();
        foreach($model->getColumnsComment() as $column => $comment) {
            $comm->load($comment);
            $list[$column] = $comm;
            $list[$column]->type = $model->getColumnType($column);
            $list[$column]->value = $model->$column;
        }
        return $list;
    }
}
