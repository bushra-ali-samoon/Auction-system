<?php

namespace App\Http\Controllers;
 
use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

 
 
 
class BidController extends Controller
{
    // Show the form for placing a bid
    public function create(Auction $auction)
    {

        return view('bids.create', compact('auction'));
    }


    // Store bid
   public function store(Request $request, $auctionId)
{
    $auction = Auction::findOrFail($auctionId);

    // check auction status
    if ($auction->status !== 'started') {
        return back()->with('error', "You cannot bid, auction is {$auction->status}.");
    }

    // check if user is owner of auction
    if ($auction->user_id == auth()->id()) {
        return back()->with('error', "You cannot bid on your own auction.");
    }

    // check if user already has 3 bids on this auction
    $bidCount = $auction->bids()->where('user_id', auth()->id())->count();
    if ($bidCount >= 3) {
        return back()->with('error', "You can only place up to 3 bids on this auction.");
    }

    // create bid
    $auction->bids()->create([
        'user_id' => auth()->id(),
        'price'   => $request->price,
    ]);

    return back()->with('success', "Bid placed successfully!");
}

}





