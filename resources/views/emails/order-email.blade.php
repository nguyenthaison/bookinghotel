<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Hi {{$user["name"]}}</h2>
        <a href="mailto:{{env('EMAIL_SENDER')}}?Subject=Hello!&body={{ $content }}" target="_top">Send Mail</a>
        <div>
            Thanks for ordering.
            In order to confirm your decision, Please send us your offer.
        </div>

    </body>
</html>