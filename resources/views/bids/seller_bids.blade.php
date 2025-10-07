<h2>Bids for Auction: {{ $auction->product }}</h2>

<table border="1" cellpadding="10" width="100%">
    <thead>
        <tr>
            <th>Buyer</th>
            <th>Price</th>
            <th>Time</th>
            <th>Winner</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bids as $bid)
        <tr>
            <td>{{ $bid->user->name }}</td>
            <td>{{ $bid->price }} Rs</td>
            <td>{{ $bid->created_at }}</td>
            <td>
                @if($bid->winner)
                    ✅ Winner
                @else
                    ❌
                @endif
            </td>
            <td>
                @if(!$bid->winner && $auction->status === 'started')
                    <a href="{{ route('bids.accept', $bid->id) }}">Accept</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-family: Arial, sans-serif;
    }

    thead {
        background: #007BFF;
        color: white;
    }

    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    tr:hover {
        background: #f1f1f1;
    }

    th {
        text-transform: uppercase;
        font-size: 14px;
    }

    td ul {
        margin: 0;
        padding-left: 18px;
    }

    a {
        color: #007BFF;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    button {
        background-color: #28a745;
        border: none;
        color: white;
        padding: 6px 10px;
        cursor: pointer;
        border-radius: 4px;
    }

    button:hover {
        background-color: #218838;
    }

    input[type="number"] {
        padding: 5px;
        width: 100px;
        margin-right: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>
