<x-layout title="コメント | つぶやきアプリ">

    <h1>コメント</h1>

    {{-- 元のつぶやき --}}
    <div>
        <p>{{ $tweet->content }}</p>
    </div>

    <hr>

    <h2>コメント一覧</h2>

    @forelse($comments as $comment)

        <div>
            <p>{{ $comment->user->name }}</p>
            <p>{{ $comment->content }}</p>
        </div>

    @empty

        <p>まだコメントはありません。</p>

    @endforelse

    <hr>

    <h2>コメントする</h2>

    <form action="{{ route('tweet.comment.store', $tweet) }}" method="POST">
        @csrf

        <textarea
            name="content"
            placeholder="コメントを入力"
        ></textarea>

        @error('content')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <button type="submit">コメントする</button>
    </form>

    <a href="{{ route('tweet.index') }}">
        戻る
    </a>

</x-layout>
