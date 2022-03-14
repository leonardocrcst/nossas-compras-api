<?php

namespace App\Models;

use database\tools\ColumnComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MyModels extends Model
{
    public function getColumnsComment(): array
    {
        $list = [];
        $columns = DB::select("SHOW FULL COLUMNS FROM {$this->table}");
        foreach($columns as $column) {
            $comment = $column->Comment;
            if($comment) {
                $comm = new ColumnComment();
                $comm->load($comment);
                $list[$column->Field] = $comm;
            }
        }
        return $list;
    }

    public function getColumnType(string $column): string
    {
        return Schema::getColumnType($this->table, $column);
    }

    public function isNullable(string $column): bool
    {
        $info = DB::select("SHOW FULL COLUMNS FROM {$this->table} WHERE FIELD = \"$column\"");
        if(count($info) && $info[0]->Null === "YES") {
            return true;
        }
        return false;
    }
}
