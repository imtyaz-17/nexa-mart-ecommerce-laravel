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
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();;
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('max_uses')->nullable();
            $table->integer('max_uses_user')->nullable();
            $table->enum('type',['percent','fixed'])->default('percent');
            $table->double('discount',10,2)->default(0);
            $table->double('min_purchased',10,2)->default(0);
            $table->boolean('status')->default(0);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_coupons');
    }
};
