<h2>{{ $auction->product }} (Status: {{ $auction->status }})</h2>

@foreach($auction->bids as $bid)
    <p>
        {{ $bid->user->name }} - {{ $bid->price }} Rs
        @if(auth()->id() === $auction->user_id && $auction->status === 'started')
            <form action="{{ route('bids.accept', $bid->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Accept</button>
            </form>
        @endif
        @if($bid->winner)
            <strong>✅ Winner</strong>
        @endif
    </p>
@endforeach
