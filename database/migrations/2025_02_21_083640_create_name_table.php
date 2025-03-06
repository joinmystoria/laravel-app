<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('name', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('first_name'); // First Name
            $table->string('last_name'); // Last Name
        });
    }

    public function down()
    {
        Schema::dropIfExists('name'); // Drops table if rolled back
    }
};
