<x-layout title="編集 | つぶやきアプリ">
    <x-layout.single>
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            つぶやきアプリ
        </h2>
        @php
            $breadcrumbs = [
                ['href' => route('tweet.index'), 'label' => 'TOP'],
                ['href' => '#','label' => '編集']
            ];

        @endphp
        <x-element.breadcrumbs :breadcrumbs="$breadcrumbs">
        </x-element.breadcrumbs>
        <x-tweet.form.put :tweet="$tweet"></x-tweet.form.put>
    </x-layout.single>
</x-layout>
{{-- <!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>つぶやきアプリ</title>
</head>
<body>

<h1>つぶやきを編集する</h1>

<div>
<a href="{{ route('tweet.index') }}">戻る</a>

<p>投稿フォーム</p>

<form action="{{ route('tweet.update.put',['tweetId' => $tweet->id]) }}" method="post">
@method('PUT')
@csrf

<label for="tweet-content">つぶやき</label>
<span>140文字まで</span>

<textarea id="tweet-content" name="tweet" placeholder="つぶやきを入力">{{ $tweet->content }}</textarea>

@error('tweet')
<p style="color: red;">{{$message}}</p>
@enderror

<button type="submit">編集</button>

</form>
</div>

@foreach($tweets as $tweet)
<p>{{ $tweet->content }}</p>
@endforeach --}}

</body>
</html>
