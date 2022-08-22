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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("thumbnail")->nullable();
            $table->string("images")->nullable();
            $table->string("title");
            $table->string("slug")->unique();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->foreignId("category_id")->constrained()->cascadeOnDelete();
            $table->longText("description");
            $table->text("excerpt");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
