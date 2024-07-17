<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/frontend/css/login.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>TourTrekker | Login</title>
</head>

<body>
    <div class="box">
        <div class="container">
            <div class="top-header">
                <span>Don't have an account?</span>
                <header>Register</header>
            </div>

            <br>
            @if (Session::has('errors'))
                <ul>
                    @foreach (Session::get('errors') as $error)
                        <li style="color: red">{{ $error[0] }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="/register_member" method="POST" class="mt-10">
                @csrf
                <div class="input-field">
                    <input type="text" class="input" placeholder="Your Name" name="nama_member" id="nama_member" required>
                    <i class="bx bxs-user"></i> <!-- Change class to the appropriate user icon -->
                </div>
                <div class="input-field">
                    <input type="text" class="input" placeholder="Your No Handphone" name="no_hp" id="no_hp" required>
                    <i class="bx bx-mobile"></i> <!-- Change class to the appropriate mobile icon -->
                </div>
                <div class="input-field">
                    <input type="text" class="input" placeholder="yourmail@example.com" name="email" id="email" required>
                    <i class="bx bx-envelope"></i> <!-- Change class to the appropriate envelope icon -->
                </div>
                <div class="input-field">
                    <input type="password" class="input" placeholder="Password" name="password" id="password" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-field">
                    <input type="password" class="input" placeholder="Confirm Password" name="konfirmasi_password" id="konfirmasi_password" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-field">
                    <input type="submit" class="submit" value="Sign Up">
                </div>
            </form>

            <div class="bottom">
                <div class="left">
                    <input type="checkbox" id="check">
                    <label for="check"> Remember Me</label>
                </div>
                <div class="right">
                    <label><a href="/register_member">Dont have an account ?</a></label>
                </div>
            </div>
        </div>
    </div>

</body>


</html>
