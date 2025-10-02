<h2>Welcome, {{ auth()->user()->name }}!</h2>
<p><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></p>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<p><a href="{{ route('auctions.index') }}">View Auctions</a></p>
