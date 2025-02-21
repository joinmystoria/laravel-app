<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('first_name'); // First Name (should be here)
            $table->string('last_name'); // Last Name (should be here)
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers'); // Drops table if rolled back
    }
};
