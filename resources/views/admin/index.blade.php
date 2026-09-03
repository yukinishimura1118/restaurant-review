<x-layout title="管理者ページ">

    <div class="max-w-6xl mx-auto mt-10">

        <h1 class="text-3xl font-bold mb-8">
            管理者ページ
        </h1>

        <h2 class="text-2xl font-bold mb-4">
            ユーザー一覧
        </h2>

        <table class="w-full border-collapse border">
            <thead>
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">名前</th>
                    <th class="border p-2">メールアドレス</th>
                    <th class="border p-2">管理者</th>
                    <th class="border p-2">状態</th>
                    <th class="border p-2">操作</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border p-2">
                            {{ $user->id }}
                        </td>

                        <td class="border p-2">
                            {{ $user->name }}
                        </td>

                        <td class="border p-2">
                            {{ $user->email }}
                        </td>

                        <td class="border p-2">
                            @if ($user->is_admin)
                                管理者
                            @else
                                一般ユーザー
                            @endif
                        </td>
                        <td class="border p-2">
                            @if ($user->is_banned)
                                BAN中
                            @else
                                通常
                            @endif
                        </td>

                        <td class="border p-2">
                            @if ($user->is_admin)
                            管理者
                        @elseif ($user->is_banned)
                            BAN済み
                        @else
                            <form method="POST"
                                  action="{{ route('admin.users.ban', $user) }}">

                                @csrf

                                <button type="submit"
                                        class="text-red-500 font-bold">
                                    BAN
                                </button>

                            </form>
                        @endif



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    <h2 class="text-2xl font-bold mt-12 mb-4">
        つぶやき一覧
    </h2>

    <table class="w-full border-collapse border">
        <thead>
            <tr>
                <th class="border p-2">ID</th>
                <th class="border p-2">ユーザー</th>
                <th class="border p-2">つぶやき</th>
                <th class="border p-2">操作</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tweets as $tweet)
                <tr>
                    <td class="border p-2">
                        {{ $tweet->id }}
                    </td>

                    <td class="border p-2">
                        {{ $tweet->user->name }}
                    </td>

                    <td class="border p-2">
                        {{ $tweet->content }}
                    </td>

                    <td class="border p-2">
                        <form method="POST"
                              action="{{ route('admin.tweets.delete', $tweet) }}">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="text-red-500 font-bold">
                                削除
                            </button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2 class="text-2xl font-bold mt-12 mb-4">
        レビュー一覧
    </h2>

    <table class="w-full border-collapse border">
        <thead>
            <tr>
                <th class="border p-2">ID</th>
                <th class="border p-2">ユーザー</th>
                <th class="border p-2">店舗</th>
                <th class="border p-2">評価</th>
                <th class="border p-2">レビュー</th>
                <th class="border p-2">操作</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td class="border p-2">{{ $review->id }}</td>
                    <td class="border p-2">{{ $review->user->name }}</td>
                    <td class="border p-2">{{ $review->restaurant->name }}</td>
                    <td class="border p-2">{{ $review->rating }}</td>
                    <td class="border p-2">{{ $review->comment }}</td>
                    <td class="border p-2">
                        <form method="POST"
                              action="{{ route('admin.reviews.delete', $review) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="text-red-500 font-bold">
                                削除
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-layout>
