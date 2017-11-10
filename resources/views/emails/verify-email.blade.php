<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Hi {{ $users->first_name }}</h2>

        <div>
            Thanks for creating an account at BaliHomeParadise.Com.
            Please follow the link below to verify your email address
            {{ URL::to( $url.'/verify/' . $users->confirmation_code) }}

        </div>

    </body>
</html>