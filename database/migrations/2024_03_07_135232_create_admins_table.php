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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
						$table->string('webSiteName');
            $table->string('merchantId');
            $table->string('saltKey');
            $table->string('email')->unique();
            $table->text('address');
						$table->longtext('addressMapUrl')->nullable();
						$table->string('contact'); 
            $table->longtext('instagram')->nullable();
            $table->longtext('facebook')->nullable(); 
            $table->longtext('youtube')->nullable();
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
