<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
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
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <img src="../images/undraw_personal_trainer_re_cnua.svg" />
                <h2 class="title">Forgot your password?</h2>
                
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Email Address -->
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" class="input" name="email" value="{{ old('email') }}" required autofocus />
                    </div>
                </div>
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
                
                <button type="submit" class="btn">Email Password Reset Link</button>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/main.js"></script>

</html>
