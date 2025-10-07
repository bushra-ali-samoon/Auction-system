<h2 style="text-align:center; margin-bottom:20px;">All Auctions</h2>

<a href="{{ route('auctions.create') }}" 
   style="display:inline-block; padding:8px 15px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px; margin-bottom:15px;">
   + Create Auction
</a>

@if(session('success'))
    <p style="color: green; font-weight:bold;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0" width="100%" 
       style="border-collapse: collapse; text-align:center; font-family: Arial, sans-serif;">
    <thead style="background:#007bff; color:white;">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Auction Start</th>
            <th>Auction End</th>
            <th>Status</th>
            <th>Bids</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($auctions as $auction)
        <tr style="background: {{ $loop->even ? '#f9f9f9' : '#fff' }};">
            <td>{{ $auction->id }}</td>
            <td>{{ $auction->product }}</td>
            <td>{{ $auction->auction_start }}</td>
            <td>{{ $auction->auction_end }}</td>
            <td>
                <strong style="color:
                    {{ $auction->status === 'sold' ? 'green' : ($auction->status === 'started' ? 'orange' : 'gray') }}">
                    {{ ucfirst($auction->status) }}
                </strong>
            </td>

            <td>
                @if($auction->bids->count() > 0)
                    <ul style="list-style:none; padding-left:0; text-align:left;">
                        @foreach($auction->bids as $bid)
                            <li>
                                <strong>{{ $bid->user->name }}</strong>: {{ $bid->price }} Rs 
                                <small style="color:#777;">({{ $bid->created_at->format('d M, H:i') }})</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <em style="color:#999;">No bids yet</em>
                @endif
            </td>

            <td>
                {{-- Buyer: can place bid --}}
                @if($auction->status === 'started' && auth()->user()->role === 'buyer')
                    <form action="{{ route('bids.store', $auction->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="number" name="price" placeholder="Enter bid" required 
                               style="padding:5px; width:80px;">
                        <button type="submit" 
                                style="padding:5px 10px; background:#28a745; color:white; border:none; border-radius:4px;">
                            Place Bid
                        </button>
                    </form>
                @endif

                {{-- Seller: can view bids --}}
                @if(auth()->id() === $auction->user_id)
                    <a href="{{ route('auctions.sellerBids', $auction->id) }}" 
                       style="margin-left:10px; padding:5px 10px; background:#ffc107; color:black; text-decoration:none; border-radius:4px;">
                       View Bids
                    </a>
                @endif

                {{-- Edit / Delete --}}
                <a href="{{ route('auctions.edit', $auction->id) }}" 
                   style="margin-left:10px; padding:5px 10px; background:#17a2b8; color:white; text-decoration:none; border-radius:4px;">
                   Edit
                </a>
@if ($auction->status === 'started' && auth()->user()->role === 'buyer')
    <a href="{{ route('bids.create', $auction->id) }}" class="btn btn-success">Place Bid</a>
@endif

                <form action="{{ route('auctions.destroy', $auction->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete this auction?')" 
                            style="margin-left:10px; padding:5px 10px; background:#dc3545; color:white; border:none; border-radius:4px;">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
