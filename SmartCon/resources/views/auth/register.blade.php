<!-- filepath: d:\CSE470\SmartCon\resources\views\auth\register.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://unpkg.com/@mizu/matcha/dist/matcha.min.css">
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        <br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <br>

        <label>Password:</label>
        <input type="password" name="password" required>
        <br>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
        <br>

        <label>Role:</label>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="faculty">Faculty</option>
            <option value="student">Student</option>
        </select>
        <br>

        <button type="submit">Register</button>
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>