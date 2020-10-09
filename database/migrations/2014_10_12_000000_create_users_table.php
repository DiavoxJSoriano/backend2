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
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            // Additional fields
            $table->string('name_first', 50)->default('')->nullable(true);
            $table->string('name_last', 50)->default('')->nullable(true);
            $table->string('address')->default('')->nullable(true);
            $table->string('username', 25)->default('')->nullable(true);
            $table->string('postcode', 10)->default('')->nullable(true);
            $table->string('contact_phone', 25)->default('')->nullable(true);
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
