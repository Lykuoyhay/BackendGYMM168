<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
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
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <img src="../images/undraw_personal_trainer_re_cnua.svg" />
                <h2 class="title">Welcome</h2>
                
                <!-- Full Name -->
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Full Name</h5>
                        <input type="text" class="input" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    </div>
                </div>
                @error('name')
                <p class="error">{{ $message }}</p>
                @enderror
                
                <!-- Email -->
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    </div>
                </div>
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
                
                <!-- Role -->
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-people-arrows"></i>
                    </div>
                    <select id="role" name="role" class="input">
                        <option selected disabled hidden>Role</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="coach" {{ old('role') == 'coach' ? 'selected' : '' }}>Coach</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                @error('role')
                <p class="error">{{ $message }}</p>
                @enderror
                
                <!-- Gender -->
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-venus-mars"></i>
                    </div>
                    <select id="gender" name="gender" class="input">
                        <option selected disabled hidden>Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        
                    </select>
                </div>
                @error('gender')
                <p class="error">{{ $message }}</p>
                @enderror
                
                <!-- Phone Number -->
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="div">
                        <h5>Phone Number</h5>
                        <input type="text" class="input" name="telephone" value="{{ old('telephone') }}" required autocomplete="tel" />
                    </div>
                </div>
                @error('telephone')
                <p class="error">{{ $message }}</p>
                @enderror
                
                <!-- Password -->
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" required autocomplete="new-password" />
                    </div>
                </div>
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
                
                <!-- Confirm Password -->
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Confirm Password</h5>
                        <input type="password" class="input" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                </div>
                @error('password_confirmation')
                <p class="error">{{ $message }}</p>
                @enderror

                <div class="issue">
                    <a href="{{ route('login') }}">Already have an account?</a>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Sign up</button>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript" src="../js/main.js"></script>

</html>
