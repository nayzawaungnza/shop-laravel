<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            // $table->string('customer_name');
            // $table->string('customer_email');
            $table->string('company_name')->nullable();

            $table->string('shipping_country_id');
            $table->string('shipping_state_id');
            $table->string('shipping_township_id');
            $table->string('shipping_zip');
            $table->string('shipping_address');


            $table->string('different_shipping_country_id')->nullable();
            $table->string('different_shipping_state_id')->nullable();
            $table->string('different_shipping_township_id')->nullable();
            $table->string('different_shipping_address')->nullable();
            $table->string('different_shipping_phone')->nullable();

            $table->string('payment_method');

            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_status', ['paid', 'unpaid', 'overdue'])->default('unpaid');
            $table->dateTime('order_date');
            $table->text('order_note')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed','processing','shipped','delivered','canceled'])->default('pending');
            //$table->integer('status')->default(0);//0->pending 1->success 2->reject
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
        Schema::dropIfExists('orders');
    }
};
