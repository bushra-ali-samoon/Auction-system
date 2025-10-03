<h2>Place Bid on: {{ $auction->product }}</h2>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('bids.store', $auction->id) }}" method="POST">
    @csrf
    <label>Bid Price:</label>
    <input type="number" step="0.01" name="price" required>
    <button type="submit">Place Bid</button>
</form>

<p><a href="{{ route('auctions.index') }}">Back to Auctions</a></p>
