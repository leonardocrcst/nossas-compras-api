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
        Schema::create('precos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("disabled_at")->nullable(true)->default(null);
            $table->bigInteger("lista", false, true)->nullable(false)->comment($this->lista());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precos');
    }

    private function lista(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Permissões";
        $comment->formCaption = "Permissões do usuário";
        $comment->description = null;
        $comment->mask = null;
        $comment->success = null;
        $comment->error = null;
        return $comment;
    }
};
