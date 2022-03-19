<!DOCTYPE html>
    <html lang="">
    <head>
        <title></title>
    </head>
    <body>
    <form method="POST" action="{{ route('admin.auth.login') }}">
        @csrf
        @method('POST')
        <label>Email</label>
        <input type="email" name="email">
        <label>Password</label>
        <input type="password" name="password">
        <button type="submit">Submit</button>
    </form>

    </body>
    </html>
