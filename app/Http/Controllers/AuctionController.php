<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    // List all auctions
    public function index()
    {
        $auctions = Auction::with('bids.user')->get();
        return view('auctions.index', compact('auctions'));
    }

    // Show create auction form
    public function create()
    {
        return view('auctions.create');
    }

    // Store new auction
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'seller') {
            abort(403, 'Only sellers can create auctions.');
        }

        $request->validate([
            'product' => 'required|string|max:255',
            'starting_price' => 'required|numeric|min:1',
            'auction_start' => 'required|date',
            'auction_end'   => 'required|date|after_or_equal:auction_start',
        ]);

        Auction::create([
            'title' => $request->product,
            'product' => $request->product,
            'starting_price' => $request->starting_price,
            'auction_start' => $request->auction_start,
            'auction_end' => $request->auction_end,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('auctions.index')->with('success', 'Auction created successfully!');
    }

    // Show auction details
    public function show($id)
    {
        $auction = Auction::with('bids.user')->findOrFail($id);
        return view('auctions.show', compact('auction'));
    }
    
}
