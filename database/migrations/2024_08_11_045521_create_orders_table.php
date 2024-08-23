<?php

use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\User;
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
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CustomerAddress::class)->constrained()->cascadeOnDelete();
            $table->double('subtotal',10,2)->default(0);
            $table->double('shipping',10,2)->default(0);
            $table->foreignIdFor(DiscountCoupon::class)->constrained()->cascadeOnDelete();
            $table->double('discount',10,2)->nullable();
            $table->double('grand_total',10,2)->default(0);
            $table->timestamps();
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
