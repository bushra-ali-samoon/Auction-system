<h2>Create New Auction</h2>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('auctions.store') }}" method="POST">
    @csrf
    <input type="text" name="product" placeholder="Product Name" required>
    <input type="datetime-local" name="auction_start" placeholder="Auction Start" required>
    <input type="datetime-local" name="auction_end" placeholder="Auction End" required>
    <button type="submit">Create</button>
</form>

<p><a href="{{ route('auctions.index') }}">Back to Auctions</a></p>
