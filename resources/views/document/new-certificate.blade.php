<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <title>Document</title>

    <style type='text/css'>
        body,
        html {
            margin: 0;
            padding: 0;
        }

        body {
            color: black;
            /* display: table; */
            font-family: Georgia, serif;
            font-size: 24px;
            text-align: center;
        }

        .container {
            border: 20px solid tan;
            width: 750px;
            height: 563px;
            /* display: table-cell; */
            vertical-align: middle;
        }

        .logo {
            color: tan;
        }

        .marquee {
            color: tan;
            font-size: 48px;
            margin: 20px;
        }

        .assignment {
            margin: 20px;
        }

        .person {
            border-bottom: 2px solid black;
            font-size: 32px;
            font-style: italic;
            margin: 20px auto;
            width: 400px;
        }

        .reason {
            margin: 20px;
        }

    </style>
</head>

<body>
    <div class="container">
        <img src="{{ $background }}" alt="background-image">
        <div class="logo">
            Papdi Purwokerto
        </div>

        <div class="marquee">
            Sertifikat
        </div>

        <div class="assignment">
            Diberikan Kepada :
        </div>

        <div class="person">
            {{ $participant->fullname }}
        </div>

        <div class="reason">
            Sebagai peserta dalam
            <br>
            <br>
            {{ $training->name }}
        </div>
    </div>
</body>

</html>