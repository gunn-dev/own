<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
</head>
<body>
    <form method="POST" action="{{route('store')}}">
        @csrf
        <label>Name</label>
        <input type="text" name="name"/><br>
        <label>Email</label>
        <input type="email" name="email"/><br>
        <label>Password</label>
        <input type="password" name="password" />
        <input type="submit" value="Submit" />
    </form>
</body>
</html>