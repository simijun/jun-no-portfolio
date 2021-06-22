<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Share YouTube</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('/CSS/star.css') }}">
        <link rel="stylesheet" href="{{ asset('/CSS/youtube.css') }}">
        
    </head>
    
    {{-- nav fixed-topで固定 → navで隠れる分を考慮してbodyの上にpaddingで余白つくる --}}
    <body style="padding-top: 6rem">

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
    
</html>