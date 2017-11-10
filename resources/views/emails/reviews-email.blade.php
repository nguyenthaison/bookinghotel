<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Dear {{ $review->guest_name }}</h2>

        <div>
            We need your help to review {{ $villa_name }}, trough
            {{ URL::to( $url.'/reviews/' . $review->token) }}

        </div>

    </body>
</html>