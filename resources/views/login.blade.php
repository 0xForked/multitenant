<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="{{ route('login.authenticate') }}" method="post">
        @csrf
        <div>
            <label for="email" style="display: block">Your email address</label>
            <input id="email" type="text" name="email" placeholder="Email" style="display: block">
            @error('email')
            <span style="color: red">{{$errors->first()}}</span>
            @enderror
        </div>
        <div style="margin-top: 10px">
            <label for="password" style="display: block">Your password</label>
            <input id="password" type="password" name="password" placeholder="Password" style="display: block">
            @error('password')
            <span style="color: red">{{$errors->first()}}</span>
            @enderror
        </div>
        <input type="submit" value="Login" style="margin-top: 10px">
    </form>

    @if(session()->has('message'))
        <p style="color: red">{{ session()->get('message') }}</p>
    @endif
</body>
</html>
