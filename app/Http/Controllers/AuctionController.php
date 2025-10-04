<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
public function index()
    {
        $auctions = Auction::with('bids.user')->get();
        return view('auctions.index', compact('auctions'));
    }
 
    public function create()
    {
        return view('auctions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'auction_start' => 'required|date',
            'auction_end'   => 'required|date|after_or_equal:auction_start',
        ]);

        Auction::create($request->all());

        return redirect()->route('auctions.index')->with('success', 'Auction created successfully!');
    }

    public function show(Auction $auction)
    {
        return view('auctions.show', compact('auction'));
    }

    public function edit(Auction $auction)
    {
        return view('auctions.edit', compact('auction'));
    }

    public function update(Request $request, Auction $auction)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'auction_start' => 'required|date',
            'auction_end'   => 'required|date|after_or_equal:auction_start',
        ]);

        $auction->update($request->all());

        return redirect()->route('auctions.index')->with('success', 'Auction updated successfully!');
    }

    public function destroy(Auction $auction)
    {
        $auction->delete();
        return redirect()->route('auctions.index')->with('success', 'Auction deleted successfully!');
    }
}
