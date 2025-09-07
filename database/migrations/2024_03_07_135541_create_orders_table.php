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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
						$table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('address');
            $table->decimal('price', 10, 2);
            $table->decimal('delivery_charges', 10, 2);
            $table->decimal('gst', 10, 2);
            $table->string('order_status')->default('pending');
            $table->integer('quantity');
            $table->timestamps();
			
			
			/*
			
				here we add a column transection_id that is foregin 
				to transection table using other migration file 
				(file name is 2024_03_08_115805_add_column_to_orders)
			
				we are enable to add beacause the transection table in not created at the time of migration so 
				that we migrate the column after transection table is created.
			*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
