<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsubscribe</title>
    <style>
        body {
            background-color: #efeaea;
        }

        .text-center {
            text-align: center;
        }
        h3{
            margin: 0px;
        }
        h1 {
            color: #f00;
        }

        .card {
            background-color: #fff;
            width: 50%;
            margin: 0 auto;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="text-center card">
        <div class="user_email">
            <h1>Done!</h1>
            <hr width="500" />
            <h2>{{$email}}</h2>
            <p>has been successfully unsubscribed from our mailing list(s)
    </p>
        </div>

</body>

</html>