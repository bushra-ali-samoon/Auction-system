<h2>All Auctions</h2>

<a href="{{ route('auctions.create') }}">+ Create Auction</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Auction Start</th>
            <th>Auction End</th>
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
            <td>
                <a href="{{ route('auctions.edit', $auction->id) }}">Edit</a> |
                <form action="{{ route('auctions.destroy', $auction->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
