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
        if(!Schema::hasTable('user_profiles')) {
            Schema::create('user_profiles', function (Blueprint $table) {
                $table->uuid('id')->primary()->increments();
                $table->uuid('user_id',false,true)->nullable();
                $table->string('image_url')->nullable();
                $table->string('country')->nullable();
                $table->string('region')->nullable();
                $table->string('district')->nullable();
                $table->string('sub_county')->nullable();
                $table->string('parish')->nullable();
                $table->string('vilage')->nullable();
                $table->string('school')->nullable();
                $table->string('exp')->nullable();
                $table->string('subject')->nullable();
                $table->text('about')->nullable();
                $table->string('twitter')->nullable();
                $table->string('facebook')->nullable();
                $table->string('instagram')->nullable();
                $table->string('slug')->nullable();
                $table->string('colo')->nullable();
                $table->boolean('status')->default(1);  // user use
                $table->boolean('state')->default(1); //admin use
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
        Schema::dropIfExists('user_profiles');
    }
};
