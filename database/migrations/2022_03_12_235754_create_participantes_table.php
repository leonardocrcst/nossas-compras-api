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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("disabled_at")->nullable(true)->default(null);
            $table->bigInteger("username", false, true)->nullable(false);
            $table->string("referencia", 256)->nullable(false)->comment($this->referencia());
            $table->foreign("username")->references("id")->on("usuarios");
            $table->unique(["username", "referencia"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participantes');
    }

    private function referencia(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "E-mail";
        $comment->formCaption = "E-mail do convidado";
        $comment->description = "E-mail do membro da família para participar da lista de compras.";
        return $comment;
    }
};
