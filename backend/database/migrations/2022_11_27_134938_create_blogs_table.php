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
        if(!Schema::hasTable('blogs')) {
            Schema::create('blogs', function (Blueprint $table) {
                $table->uuid('id')->primary()->increments();
                $table->uuid('user_id')->nullable();
                $table->string('title')->nullable();
                $table->string('caption')->nullable();
                $table->string('meta')->nullable();
                $table->text('details')->nullable();
                $table->string('image')->nullable();
                $table->string('image_url')->nullable();
                $table->boolean('status')->default(1);
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
        Schema::dropIfExists('blogs');
    }
};
