<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>レビュー編集</title>

    <style>
        body {
            font-family: sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        select,
        textarea,
        input[type="file"] {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        .error {
            background-color: #ffe5e5;
            border: 1px solid #ffaaaa;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .error p {
            margin: 5px 0;
            color: #cc0000;
        }

        .current-image {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background-color: #333;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #2563eb;
            text-decoration: none;
        }

        .back:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>レビュー編集</h1>

        {{-- バリデーションエラー --}}
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form
            action="{{ route('reviews.update', $review) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="form-group">

                <label for="rating">
                    評価
                </label>

                <select id="rating" name="rating">

                    <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>
                        ★☆☆☆☆
                    </option>

                    <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>
                        ★★☆☆☆
                    </option>

                    <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>
                        ★★★☆☆
                    </option>

                    <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>
                        ★★★★☆
                    </option>

                    <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>
                        ★★★★★
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label for="comment">
                    レビュー
                </label>

                <textarea
                    id="comment"
                    name="comment"
                    placeholder="お店の感想を書いてください"
                >{{ old('comment', $review->comment) }}</textarea>

            </div>

             {{-- 現在の画像 --}}
              @if ($review->image)
              <div class="form-group">

              <label>
            現在の写真
             </label>

        <img
            src="{{ asset('storage/' . $review->image) }}"
            alt="レビュー画像"
            style="width: 300px; max-width: 100%; border-radius: 8px; display: block; margin-bottom: 10px;"
        >

        <label style="font-weight: normal;">
            <input
                type="checkbox"
                name="delete_image"
                value="1"
            >
            この画像を削除する
        </label>

    </div>
@endif



            {{-- 新しい画像 --}}
            <div class="form-group">

                <label for="image">
                    写真を変更する
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept="image/*"
                >

            </div>


            <button type="submit">
                レビューを更新する
            </button>

        </form>


        <a
            class="back"
            href="{{ route('restaurants.show', $review->restaurant_id) }}"
        >
            ← お店の詳細に戻る
        </a>

    </div>

</div>

</body>
</html>

