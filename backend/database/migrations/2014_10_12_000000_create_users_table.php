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
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->uuid('id')->primary()->increments();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('contact');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('slug')->nullable();
                $table->string('password');
                $table->boolean('status')->default(1);
                $table->rememberToken();
                $table->timestamps();
            });

        }
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
