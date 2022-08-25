<?php

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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text("message");
            $table->foreignId("article_id")->constrained()->cascadeOnDelete();
            $table->bigInteger("article_owner_id")->references("user_id")->on("articles")->onDelete("cascade");
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->enum("status",["0","1"])->default("0");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
