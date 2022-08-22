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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("username")->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum("gender",["0","1"])->nullable();
            $table->enum("role",["0","1"])->default("1");
            $table->enum("isBanned",["0","1"])->default("0");
            $table->text("bio")->nullable();
            $table->string("profile")->nullable();
            $table->string("avatar")->nullable();
            $table->string("provider_id")->nullable();
            $table->text("livein")->nullable();
            $table->string("phone")->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
