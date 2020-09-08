<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('login')->unique();
            $table->date('birthday')->nullable();
            $table->string('state')->nullable();
            $table->string('sex')->nullable();
            $table->string('cin')->nullable();
            $table->string('passport')->nullable();
            $table->string('cnss')->nullable();
            $table->string('school')->nullable();
            $table->string('history')->nullable();
            $table->string('experience')->nullable();
            $table->string('source')->nullable();
            $table->date('hired_at')->nullable();
            $table->string('department')->nullable();
            $table->string('poste')->nullable();
            $table->date('ends_at')->nullable();
            $table->string('grade')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('company')->nullable();
            $table->unsignedBigInteger('supervisor_id');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('supervisor_id')->references('id')->on('users');
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
}
