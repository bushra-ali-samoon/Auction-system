<h2>All Auctions</h2>

<a href="{{ route('auctions.create') }}">+ Create Auction</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" width="100%">
    <thead>
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
        <tr>
            <td>{{ $auction->id }}</td>
            <td>{{ $auction->product }}</td>
            <td>{{ $auction->auction_start }}</td>
            <td>{{ $auction->auction_end }}</td>
            <td>{{ $auction->status }}</td>
            <td>
                @if($auction->bids->count() > 0)
                    <ul>
                        @foreach($auction->bids as $bid)
                            <li>
                                {{ $bid->user->name }}: {{ $bid->price }} Rs 
                                (at {{ $bid->created_at }})
                            </li>
                        @endforeach
                    </ul>
                @else
                    <em>No bids yet</em>
                @endif
            </td>
            <td>
                <a href="{{ route('auctions.edit', $auction->id) }}">Edit</a> |

                {{-- Agar auction started hai tabhi bid form dikhana --}}
                @if($auction->status === 'started')
                    <form action="{{ route('bids.store', $auction->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="number" name="price" placeholder="Enter bid" required>
                        <button type="submit">Place Bid</button>
                    </form>
                @else
                    <strong>You cannot bid. Auction is {{ $auction->status }}.</strong>
                @endif

                | <form action="{{ route('auctions.destroy', $auction->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
