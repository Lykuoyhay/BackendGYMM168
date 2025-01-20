<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <img class="wave" src="../images/wave.png" />
    <div class="container">
        <div class="img">
            <img src="../images/undraw_working_out_re_nhkg.svg" />
        </div>
        <div class="login-content">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <img src="../images/undraw_personal_trainer_re_cnua.svg" />
                <h2 class="title">Welcome</h2>
                
                <!-- Email Address -->
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" class="input" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    </div>
                </div>
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
                
                <!-- Password -->
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" required autocomplete="current-password" />
                    </div>
                </div>
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
                
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="issue">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                    <a href="{{ route('register') }}" class="ms-4">New Here?</a>
                </div>
                <button type="submit" class="btn">Log in</button>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/main.js"></script>

</html>
