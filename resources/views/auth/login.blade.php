<h2>Login</h2>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <label><input type="checkbox" name="remember"> Remember Me</label>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="{{ route('register.form') }}">Register</a></p>
