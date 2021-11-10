<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <div>
        <table border>
            <tr>
                <td>Name:</td>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <td>verified:</td>
                <td>{{$user->email_verified_at ? 'YES' : 'NO'}}</td>
            </tr>
        </table>
    </div>

    {{ cache()->get('user') }}

    <form action="{{route('logout')}}" method="post">
        @csrf
        <button>Logout</button>
    </form>
</body>
</html>
