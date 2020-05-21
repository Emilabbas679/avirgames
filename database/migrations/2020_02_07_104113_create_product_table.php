<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('platform_id');
            $table->enum('ads_type', ['general','vip', 'premium'])->default('general');
            $table->date('premium_deadline')->nullable();
            $table->enum('condition', ['new', 'old']);
            $table->integer('city_id');
            $table->text('description')->nullable();
            $table->enum('type', ['sell','hire','barter','mix']);
            $table->float('sell_price')->nullable();
            $table->integer('hire_period_id')->default(0);
            $table->float('hire_price')->nullable();
            $table->text('hire_description')->nullable();
            $table->enum('barter_type', ['equal', 'give_money', 'take_money'])->nullable();
            $table->float('barter_money')->nullable();
            $table->enum('status', ['pending','accepted', 'rejected'])->default('pending');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('product');
    }
}
