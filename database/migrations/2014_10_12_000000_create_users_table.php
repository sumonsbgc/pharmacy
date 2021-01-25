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
            $table->string('first_name', 70);
            $table->string('last_name', 70);
            $table->string('name', 140);
            $table->string('username', 50)->unique()->nullable();
            $table->string('email', 70)->unique();
            $table->string('mobile', 15)->unique()->nullable();
            $table->string('password', 170);
            $table->string('profile_pic')->nullable();
            $table->string('gender', 11)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('country', 30)->nullable();
            $table->string('city', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('user_type', 20)->nullable()->comment('Admin, Employee');
            $table->timestamp('email_verified_at')->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->rememberToken(); // 
            $table->timestamps();// created_at, updated_at
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
