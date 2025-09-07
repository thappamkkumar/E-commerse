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
		/*
			this migration is use to add transaction_id column into orders table. 
			beacause the transection table in not created at the time of migration so 
				that we migrate the column after transection table is created.
		*/
        Schema::table('orders', function (Blueprint $table) {
            //
			
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
			$table->dropColumn('transaction_id');
        });
    }
};
