<?php

namespace App\Models;

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
                $list[$column->Field] = $comment;
            }
        }
        return $list;
    }

    public function getColumnType(string $column): string
    {
        return Schema::getColumnType($this->table, $column);
    }
}
