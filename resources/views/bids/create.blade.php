@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Place a Bid for: {{ $auction->product }}</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('bids.store', $auction->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="price" class="form-label">Your Bid Price</label>
            <input type="number" name="price" id="price" step="0.01" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Place Bid</button>
        <a href="{{ route('auctions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
