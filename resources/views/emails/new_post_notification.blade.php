<!DOCTYPE html>
<html>
<head>
    <title>Nova notícia no Choquei Conça</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #785AFA;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h1 {
            color: #333333;
        }
        .content h2 {
            color: #785AFA;
        }
        .footer {
            background-color: #f4f4f4;
            color: #999999;
            text-align: center;
            padding: 10px;
            border-radius: 0 0 8px 8px;
            font-size: 12px;
        }
        .footer a {
            color: #785AFA;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Choquei Conça</h1>
        </div>
        <div class="content">
            <h1>Olá, {{ $userName }}</h1>
            <p>Temos uma fofoca pra te contar <p>&#129323;</p>:</p>
            <h2>{{ $postTitle }}</h2>
            <p>
                <img src="{{ asset('/images/fofoca-anafofoca.gif') }}" alt="Gif fofoca" style="max-width: 100%; height: auto; border-radius: 8px;">
            </p>
        </div>
        <div class="footer">
            <p>Obrigado por acompanhar as notícias na Choquei Conça.</p>
            <p>Visite nosso <a href="{{ url('/') }}">site</a> para mais informações.</p>
        </div>
    </div>
</body>
</html>
