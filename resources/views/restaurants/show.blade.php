<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $restaurant->name }}</title>

    <style>
        body {
            font-family: sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 25px;
        }

        h2 {
            margin-top: 0;
        }

        .info {
            margin-bottom: 10px;
        }

        .stars {
            color: #f5a623;
            font-size: 24px;
        }

        .review {
            background-color: #f9f9f9;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .review p {
            margin: 8px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 18px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #555;
        }

        .edit {
            color: #2563eb;
            text-decoration: none;
            margin-right: 10px;
        }

        .edit:hover {
            text-decoration: underline;
        }
　　　　　


        .delete-button {
            border: none;
            background-color: #dc2626;
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #b91c1c;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #2563eb;
            text-decoration: none;
        }

        .back:hover {
            text-decoration: underline;
        }

        .no-review {
            color: #777;
        }
    </style>
</head>

<body>

<div class="container">

    {{-- お店情報 --}}
    <div class="card">

        <h1>{{ $restaurant->name }}</h1>

        <p class="info">
            <strong>住所：</strong>
            {{ $restaurant->address }}
        </p>
        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restaurant->address) }}"
            target="_blank"
            rel="noopener noreferrer"
            class="button"
            >
            　　📍 地図を見る
        </a>

        <p class="info">
            <strong>ジャンル：</strong>
            {{ $restaurant->genre }}
        </p>

        <p>
            {{ $restaurant->description }}
        </p>

    </div>


    {{-- 平均評価 --}}
    <div class="card">

        <h2>平均評価</h2>

        @if ($restaurant->reviews->count() > 0)

            <p class="stars">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= round($averageRating))
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </p>

            <p>
                {{ number_format($averageRating, 1) }} / 5
            </p>

        @else

            <p class="no-review">
                まだ評価がありません。
            </p>

        @endif

        <a class="button" href="{{ route('reviews.create', $restaurant) }}">
            このお店をレビューする
        </a>

    </div>


    {{-- レビュー --}}
    <div class="card">

        <h2>レビュー</h2>

        <form action="{{ route('restaurants.show', $restaurant) }}" method="GET" style="margin-bottom: 20px;">

            <label for="sort">
                並び替え：
            </label>

            <select id="sort" name="sort" onchange="this.form.submit()">

                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>
                    新しい順
                </option>

                <option value="highest" {{ $sort === 'highest' ? 'selected' : '' }}>
                    評価が高い順
                </option>

                <option value="lowest" {{ $sort === 'lowest' ? 'selected' : '' }}>
                    評価が低い順
                </option>

            </select>

        </form>

        @forelse ($reviews as $review)
        　　　
        <div class="review">

            <p>
                <strong>投稿者：</strong>
                {{ $review->user->name }}
            </p>

            <p class="stars">
                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
            </p>

            {{-- レビュー本文 --}}
            <p>
                {{ $review->comment }}
            </p>

            {{-- レビュー画像 --}}
            @if ($review->image)
                <div style="margin-top: 10px; margin-bottom: 15px;">
                    <img
                        src="{{ asset('storage/' . $review->image) }}"
                        alt="レビュー画像"
                        style="display: block; width: 300px; max-width: 100%; border-radius: 8px;"
                    >
                </div>
            @endif

            {{-- 編集・削除ボタン --}}
            @if (auth()->id() === $review->user_id)

                <div style="display: block; margin-top: 10px;">

                    <a
                        class="edit"
                        href="{{ route('reviews.edit', $review) }}"
                    >
                        編集
                    </a>

                    <form
                        action="{{ route('reviews.destroy', $review) }}"
                        method="POST"
                        style="display: inline;"
                        onsubmit="return confirm('削除してもよろしいですか？');"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            class="delete-button"
                            type="submit"
                        >
                            削除
                        </button>

                    </form>

                </div>

            @endif

        </div>　　

        @empty

            <p class="no-review">
                まだレビューがありません。
            </p>

        @endforelse

    </div>


    {{-- 一覧に戻る --}}
    <a class="back" href="{{ route('restaurants.index') }}">
        ← 飲食店一覧に戻る
    </a>

</div>

</body>
</html>

