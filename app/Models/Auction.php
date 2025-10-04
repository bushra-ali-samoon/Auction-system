<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = ['product', 'auction_start', 'auction_end'];

 public function bids()
{
    return $this->hasMany(Bid::class);
}
// public function getStatusAttribute()
// {
//     $now = now();

//     if ($now->lt($this->auction_start)) {
//         return 'pending';
//     } elseif ($now->between($this->auction_start, $this->auction_end)) {
//         return 'started';
//     } else {
//         return 'ended';
//     }
// }


}
