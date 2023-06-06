<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('source_id')->nullable();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique();

            $table->string('phone')->nullable();
            $table->string('website')->nullable();

            $table->string('street')->nullable();
            $table->string('suite')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_catch_phrase')->nullable();
            $table->string('company_bs')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
