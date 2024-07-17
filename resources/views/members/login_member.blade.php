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
                <span>Have an account?</span>
                <header>Login</header>
            </div>

            <br>
            @if (Session::has('errors'))
                <ul>
                    @foreach (Session::get('errors') as $error)
                        <li style="color: red">{{ $error[0] }}</li>
                    @endforeach
                </ul>
            @endif

            @if (Session::has('success'))
                <p style="color: green">{{ Session::get('success') }}</p>
            @endif

            @if (Session::has('failed'))
                <p style="color: red">{{ Session::get('failed') }}</p>
            @endif
            <form action="/login_member" method="POST" class="mt-10">
                @csrf
                <div class="input-field">
                    <input type="text" class="input" placeholder="Email" name="email" id="email" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-field">
                    <input type="password" class="input" placeholder="Password" name="password" id="password"
                        required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-field">
                    <input type="submit" class="submit" value="Login">
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
