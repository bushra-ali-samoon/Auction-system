<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'user_id', 'auction_id', 'winner'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
