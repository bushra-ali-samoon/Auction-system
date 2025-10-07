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
    Schema::create('auctions', function (Blueprint $table) {
        $table->id();
        $table->string('title');  
        $table->string('product'); 
        $table->decimal('starting_price', 10, 2);  
$table->enum('status', ['pending', 'started', 'sold', 'expired'])->default('pending');
        $table->timestamp('auction_start')->useCurrent();
        $table->timestamp('auction_end')->useCurrent();

        $table->unsignedBigInteger('user_id'); 
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
   
        $table->timestamps();
    });


}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
