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

        .unsubscribe_reason {
            width: 100%;
        }

        .unsubscribe_reason textarea {
            padding: 10px;
        }

        .unsubscribe_btn button {
            padding: 10px;
            margin-top: 10px;
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
            <h2>{{$email}}</h2>
            <h5>is subscribed to our mailing list(s).</h5>
            <hr width="500" />
            <h1>Unsubscribe from our mailing list</h1>
            <p>To help us improve our services, we would be grateful if you could tell us why:
            </p>
        </div>

        <div>
            <form class="unsubscribe_form" method="POST" action="{{url('/unsubscribed')}}">
                @csrf
                <div class="unsubscribe_reason">
                    <textarea name="unsubscribe_reason" rows="4" cols="70"
                        placeholder="Enter unsubscribe reason here..."></textarea>
                    <input name="user_token" type="hidden" value="{{base64_encode($email)}}" />
                </div>
                <div class="unsubscribe_btn">
                    <button type="submit">Unsubscribe</button>
                </div>
            </form>
        </div>
</body>

</html>