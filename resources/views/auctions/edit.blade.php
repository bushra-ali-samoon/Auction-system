<h2>Edit Auction</h2>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('auctions.update', $auction->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="product" value="{{ $auction->product }}" required>
    <input type="datetime-local" name="auction_start" value="{{ \Carbon\Carbon::parse($auction->auction_start)->format('Y-m-d\TH:i') }}" required>
    <input type="datetime-local" name="auction_end" value="{{ \Carbon\Carbon::parse($auction->auction_end)->format('Y-m-d\TH:i') }}" required>
    <button type="submit">Update</button>
</form>

<p><a href="{{ route('auctions.index') }}">Back to Auctions</a></p>
