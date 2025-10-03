<?php

namespace App\Http\Controllers;
 
use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function create($auctionId)
    {
        $auction = Auction::findOrFail($auctionId);
        return view('bids.create', compact('auction'));
    }

    public function store(Request $request, Auction $auction)
{
    // Rule 1: User cannot bid on his own auction
    if ($auction->user_id == auth()->id()) {
        return back()->withErrors('You cannot bid on your own auction.');
    }

    // Rule 2: User can place max 3 bids on same auction
    $userBidCount = $auction->bids()->where('user_id', auth()->id())->count();
    if ($userBidCount >= 3) {
        return back()->withErrors('You can only place up to 3 bids on this auction.');
    }

    // Validation
    $request->validate([
        'price' => 'required|numeric|min:1',
    ]);

    // Save bid
    $auction->bids()->create([
        'price' => $request->price,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('auctions.index')->with('success', 'Bid placed successfully!');
}

}

