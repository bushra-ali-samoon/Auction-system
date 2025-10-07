<h2>Register</h2>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <label for="role">Role</label>
<select name="role" required>
    <option value="buyer">Buyer</option>
    <option value="seller">Seller</option>
</select>

    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="{{ route('login.form') }}">Login</a></p>
