<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;

class BidController extends Controller
{
    // 1️⃣ Buyer: Show bid form
  public function create($auctionId)
{
    $auction = Auction::findOrFail($auctionId);

    // 🔹 Step 1: Only buyers can place bids
    if (auth()->user()->role !== 'buyer') {
        abort(403, 'Only buyers can place bids.');
    }

    // 🔹 Step 2: Only active auctions
    if ($auction->status !== 'started') {
        return back()->with('error', 'You cannot bid on this auction.');
    }

    return view('bids.create', compact('auction'));
}


    // 2️⃣ Buyer: Store bid
 public function store(Request $request, $auctionId)
{
    $auction = Auction::findOrFail($auctionId);

    // 🔹 Step 1: Only buyers can place bids
    if (auth()->user()->role !== 'buyer') {
        abort(403, 'Only buyers can place bids.');
    }

    // 🔹 Step 2: Auction must be active
    if ($auction->status !== 'started') {
        return back()->with('error', 'You cannot bid on this auction.');
    }

    $request->validate([
        'price' => 'required|numeric|min:1',
    ]);

    Bid::create([
        'auction_id' => $auction->id,
        'user_id'    => auth()->id(),
        'price'      => $request->price,
        'winner'     => 0,
    ]);

    return redirect()->route('auctions.index')->with('success', 'Bid placed successfully!');
}


    // 3️⃣ Seller: Accept a bid
    public function accept($id)
    {
        $bid = Bid::findOrFail($id);
        $auction = $bid->auction;

        // Only the seller of this auction can accept a bid
        if ($auction->user_id !== auth()->id()) {
            abort(403, 'Only the seller can accept a bid.');
        }

        // Auction must still be active
        if ($auction->status !== 'started') {
            return back()->with('error', 'This auction is not active anymore.');
        }

        // Mark auction as sold
        $auction->update(['status' => 'sold']);

        // Reset all other bids to winner = 0
        Bid::where('auction_id', $auction->id)->update(['winner' => 0]);

        // Mark this bid as winner = 1
        $bid->update(['winner' => 1]);

        return back()->with('success', 'Bid accepted! Auction sold.');
    }

    // 4️⃣ Seller: View all bids for an auction
    public function sellerBids($auctionId)
    {
        $auction = Auction::findOrFail($auctionId);

        // Only seller can view
        if ($auction->user_id !== auth()->id()) {
            abort(403, 'You are not allowed to view this auction.');
        }

        // Load all bids with buyer info
        $bids = $auction->bids()->with('user')->get();

        return view('bids.seller_bids', compact('auction', 'bids'));
    }
}
