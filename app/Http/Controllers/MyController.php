<?php

namespace App\Http\Controllers;

include_once "../database/tools/ColumnComment.php";

use App\Http\Controllers\Responses\Responses;
use App\Models\MyModels;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MyController extends Controller
{
    public array $response;

    public function getList(MyModels $model): Builder
    {
        $data = $model->whereNull("disabled_at");
        $data->select(array_keys($this->getColumns($model)));
        return $data;
    }

    public function getCreate(MyModels $model): Responses
    {
        $form = new \stdClass();
        $form->columns = $this->getColumns($model);
        return new Responses($form,200, [], "field");
    }

    public function setStoreData(MyModels &$model, Request $request): bool
    {
        $columns = $this->getColumns($model);
        foreach($columns as $column => $info) {
            $value = $request->json($column);
            if ($this->dataValidate($column, $value, $info->type, $model->isNullable($column))) {
                $model->$column = $value;
            }
        }
        return empty($this->response);
    }

    public function setUpdateData(MyModels &$model, Request $request): bool
    {
        $columns = $this->getColumns($model);
        $fieldList = $request->toArray();
        foreach($fieldList as $column => $value) {
            if(!is_null($model->$column)) {
                if ($this->dataValidate($column, $value, $columns[$column]->type, $model->isNullable($column))) {
                    $model->$column = $value;
                }
            } else {
                $this->log("'$column' campos inválido.", "error");
            }
        }
        return empty($this->response);
    }

    public function setPagination(Builder $data, Request $request): LengthAwarePaginator
    {
        return $data->paginate($request->input("r") ?? 10);
    }

    private function getColumns(MyModels $model): array
    {
        $list = [];
        foreach($model->getColumnsComment() as $column => $comment) {
            $list[$column] = $comment;
            $list[$column]->type = $model->getColumnType($column);
            $list[$column]->value = $model->$column;
        }
        return $list;
    }

    private function dataValidate($column, $value, $type, bool $nullable = false): bool
    {
        if((is_null($value) && $nullable) || $this->typeMatch($value, $type)) {
            return true;
        } elseif(is_null($value)) {
            $this->log("'$column' não pode ser nulo.", "error");
        } else {
            $this->log("'$column' espera um valor do tipo $type.", "error");
        }
        return false;
    }

    private function typeMatch(mixed $value, string $type): bool
    {
        $integer = ["tinyint", "smallint", "mediumint", "int", "integer", "bigint"];
        $double = ["decimal", "dec", "numeric", "fixed", "float", "double", "double precision"];
        $string = ["char", "enum", "mediumtext", "longtext", "text", "tinytext", "varchar", "set", "string"];
        $timestamp = ["data", "time", "datetime", "timestamp", "year"];
        $boolean = ["bit"];
        $check = gettype($value);
        $check = $check === "object" ? "DateTime" : $check;
        switch ($type) {
            case in_array($type, $integer) && $check === "integer":
            case in_array($type, $double) && $check === "double":
            case in_array($type, $timestamp) && $check === "DateTime":
            case in_array($type, $boolean) && $check === "boolean":
            case in_array($type, $string) && $check === "string":
                return true;
            default:
                return false;
        }
    }

    private function log(string $string, string $type)
    {
        if(empty($this->response)) {
            $this->response = [];
        }
        if(!array_key_exists($type, $this->response)) {
            $this->response[$type] = [];
        }
        $this->response[$type][] = $string;
    }
}
