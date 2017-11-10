<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Hi {{ $users->first_name }}</h2>

        <div>
            Someone from {{ $ip }} has changed your password.

        </div>

    </body>
</html>