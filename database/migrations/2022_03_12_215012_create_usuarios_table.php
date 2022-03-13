<?php

include_once "database/tools/ColumnComment.php";

use database\tools\ColumnComment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("disabled_at")->nullable(true)->default(null);
            $table->string("username", 256)->nullable(false)->unique()->comment($this->username());
            $table->string("password", 60)->nullable(false)->comment($this->password());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }

    private function username(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->formCaption = "E-mail";
        return $comment;
    }

    private function password(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->formCaption = "Senha";
        return $comment;
    }
};
