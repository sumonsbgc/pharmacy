<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // 200 
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('brand_id')->constrained('brands');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->string('sku', 70)->nullable();
            $table->string('barcode', 50)->nullable();

            $table->integer('total_quantity');
            $table->float('sales_price');

            $table->text('description')->nullable();
            $table->string('thumbnail', 150)->nullable();

            $table->enum('status', ['Publish', 'Pending', 'Draft'])->nullable()->default('pending');
            
            $table->timestamp('expiry_date')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
