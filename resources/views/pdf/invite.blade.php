<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap");

        * {
            font-family: "Atkinson Hyperlegible", sans-serif;
        }

        body {
            background-color: #FDFDFC;
            color: #1b1b18;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
            min-height: 100vh;
        }

        .container {
            width: 100vw;
            height: 100vh;
            padding: 24px;
            border-radius: 20px;
            border: 1px solid #e4e4e4;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 128px;
        }

        .qrcode-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 288px;

            border-radius: 10px;
            margin-bottom: 20px;
        }

        .qrcode-container img {
            max-width: 100%;
            max-height: 100%;
        }

        .title {
            font-size: 20px;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 10px;
        }

        .description {
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="qrcode-container">
            <img src="{{ $qrCode }}" alt="QR Code">
        </div>

    </div>
</body>

</html>
