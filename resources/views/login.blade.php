<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="styles1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <form method="POST" action="{{ route('login') }}"> 
            @csrf  {{-- Token de seguridad obligatorio --}}

            <h1>Sign In</h1>

            @if (session('error'))
                <p style="color: red;">{{ session('error') }}</p>
            @endif

            <div class="input-box">
                <input type="email" name="email" placeholder="email@techmahindra.org" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" name="remember"> Remember me</label>
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>

            <div class="login">
                <button type="submit" class="btn">Login</button>
            </div>

            <div class="register-link">
                <p>Don't have an account? <a href="#">Register</a></p>
            </div>

            <div class="terms">
                <p>By clicking continue, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></p>
            </div>
        </form>
    </div>
</body>
</html>