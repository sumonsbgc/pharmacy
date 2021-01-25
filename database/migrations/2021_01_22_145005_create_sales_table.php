<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('customer_id')->constrained('customers');
            
            $table->integer('quantity');
            $table->decimal('sales_price', 8, 2);
            $table->decimal('total_amount', 8, 2);

            $table->enum('sales_type', ['Cash', 'Cheque', 'Due', 'Mobile Banking']);
            
            $table->decimal('paid_amount', 8, 2);
            $table->decimal('due_amount', 8, 2)->nullable();
            $table->date('pay_back_date')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
