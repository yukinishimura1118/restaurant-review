<x-layout title="コメント | つぶやきアプリ">

    <div class="max-w-4xl mx-auto px-4 py-8">

        {{-- パンくず --}}
        <div class="mb-6 flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('tweet.index') }}"
               class="hover:text-blue-500">
                TOP
            </a>

            <span>›</span>

            <span class="text-gray-700">
                コメント
            </span>
        </div>


        {{-- メインカード --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            {{-- タイトル --}}
            <div class="px-6 py-5 border-b">
                <h1 class="text-2xl font-bold text-blue-500">
                    つぶやき
                </h1>
            </div>


            {{-- 元のつぶやき --}}
            <div class="px-6 py-6">

                <div class="flex items-center gap-3 mb-4">

                    {{-- ユーザーアイコン --}}
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-xl">
                            👤
                        </span>
                    </div>

                    <div>
                        <p class="font-bold text-gray-800">
                            {{ $tweet->user->name ?? 'ユーザー' }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $tweet->created_at->format('Y/m/d H:i') }}
                        </p>
                    </div>

                </div>


                {{-- つぶやき本文 --}}
                <p class="text-lg text-gray-800 leading-relaxed">
                    {{ $tweet->content }}
                </p>


                {{-- いいね・コメント --}}
                <div class="mt-5 pt-4 border-t flex items-center gap-6 text-gray-500">

                    <span class="text-red-500 font-semibold">
                        ♥ {{ $tweet->likes->count() }} いいね
                    </span>

                    <span class="text-blue-500 font-semibold">
                        💬 {{ $comments->count() }} コメント
                    </span>

                </div>

            </div>


            {{-- コメント一覧 --}}
            <div class="px-6 py-6 border-t">

                <h2 class="text-xl font-bold text-blue-500 mb-5">
                    コメント一覧
                    <span class="text-gray-500 text-base">
                        （{{ $comments->count() }}件）
                    </span>
                </h2>


                @forelse($comments as $comment)

                    <div class="py-5 border-t first:border-t-0">

                        <div class="flex items-start gap-3">

                            {{-- ユーザーアイコン --}}
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center flex-shrink-0">
                                <span class="text-gray-500">
                                    👤
                                </span>
                            </div>


                            <div class="flex-1">

                                <div class="flex items-center gap-3">

                                    <p class="font-bold text-gray-800">
                                        {{ $comment->user->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $comment->created_at->format('Y/m/d H:i') }}
                                    </p>

                                </div>


                                <p class="mt-2 text-gray-700 leading-relaxed">
                                    {{ $comment->content }}
                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="py-8 text-center text-gray-500">
                        まだコメントはありません。
                    </div>

                @endforelse

            </div>


            {{-- コメント投稿 --}}
            <div class="px-6 py-6 border-t">

                <h2 class="text-xl font-bold text-blue-500 mb-4">
                    コメントする
                </h2>


                <form
                    action="{{ route('tweet.comment.store', $tweet) }}"
                    method="POST"
                >

                    @csrf


                    <textarea
                        name="content"
                        rows="5"
                        maxlength="500"
                        placeholder="コメントを入力"
                        class="w-full rounded-lg border border-gray-300 p-4
                               text-gray-800
                               placeholder-gray-400
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-400
                               focus:border-blue-400
                               resize-none"
                    >{{ old('content') }}</textarea>


                    {{-- バリデーションエラー --}}
                    @error('content')

                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror


                    {{-- 送信ボタン --}}
                    <div class="mt-4 flex justify-end">

                        <button
                            type="submit"
                            class="px-6 py-3
                                   bg-blue-500
                                   hover:bg-blue-600
                                   text-white
                                   font-bold
                                   rounded-lg
                                   shadow
                                   transition"
                        >
                            💬 コメントする
                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- 戻る --}}
        <div class="mt-6">

            <a
                href="{{ route('tweet.index') }}"
                class="inline-block
                       px-5 py-3
                       bg-white
                       border
                       border-gray-300
                       rounded-lg
                       text-gray-700
                       font-semibold
                       shadow-sm
                       hover:bg-gray-50
                       transition"
            >
                ← つぶやき一覧に戻る
            </a>

        </div>

    </div>

</x-layout>



{{-- <x-layout title="コメント | つぶやきアプリ">

    <h1>コメント</h1>

    <h2>{{ $tweet->content }}</h2>

    <hr>

    <h3>コメント一覧</h3>

    @forelse($comments as $comment)

        <div>
            <p>{{ $comment->user->name }}</p>
            <p>{{ $comment->content }}</p>
        </div>

    @empty

        <p>まだコメントはありません。</p>

    @endforelse

    <hr>

    <h3>コメントする</h3>

    <form action="{{ route('tweet.comment.store', $tweet) }}" method="POST">
        @csrf

        <textarea
            name="content"
            placeholder="コメントを入力"
        ></textarea>

        @error('content')
            <p style="color: red;">
                {{ $message }}
            </p>
        @enderror

        <button type="submit">
            コメントする
        </button>
    </form>

    <br>

    <a href="{{ route('tweet.index') }}">
        戻る
    </a>

</x-layout> --}}
