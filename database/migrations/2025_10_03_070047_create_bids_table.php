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
    Schema::create('bids', function (Blueprint $table) {
        $table->id();
        $table->decimal('price', 10, 2);
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('auction_id');
        $table->timestamps();
        $table->boolean('winner')->default(0);

         // Foreign keys
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
