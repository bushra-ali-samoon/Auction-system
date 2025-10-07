<h2>My Auctions</h2>
<p>Seller: {{ $auction->user->name }}</p>

<h3>Bids</h3>
@if($auction->bids->isEmpty())
    <p>No bids yet</p>
@else
    <ul>
        @foreach($auction->bids as $bid)
            <li>{{ $bid->user->name }} ({{ $bid->user->role }}): ${{ $bid->price }}</li>
        @endforeach
    </ul>
@endif

<ul>
@foreach($auctions as $auction)
    <li>{{ $auction->product }} - Start: {{ $auction->auction_start }} - End: {{ $auction->auction_end }}</li>
@endforeach
</ul>
