<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifikasi Komentar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #1a202c;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 10px;
        }

        .content {
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4a5568;
            color: #fff !important;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #718096;
            border-top: 1px solid #edf2f7;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>
            @if ($isReply)
                Balasan Baru pada Komentar Anda
            @else
                Komentar Baru pada Postingan Anda
            @endif
        </h1>

        <div class="content">
            <p>Halo {{ $recipient->name }},</p>

            @if ($isReply)
                <p>Ada balasan baru pada komentar Anda di postingan **"{{ $comment->post->title }}"**.</p>
            @else
                <p>Ada komentar baru pada postingan **"{{ $comment->post->title }}"**.</p>
            @endif
        </div>

        <h3>Isi Komentar:</h3>
        <div style="background-color: #f7fafc; padding: 15px; border-radius: 5px; border: 1px solid #e2e8f0;">
            <p>{!! $comment->content !!}</p>
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ route('posts.show', ['post' => $comment->post, 'comment' => $comment->id]) }}"
                class="button">Lihat Komentar</a>
        </div>

        <div class="footer">
            <p>Terima kasih,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>
