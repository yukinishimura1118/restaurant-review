<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>飲食店登録</title>

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
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        textarea {
            min-height: 120px;
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

        <h1>飲食店を登録</h1>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form
            action="{{ route('restaurants.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="form-group">
                <label for="name">店名</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="例：ラーメン山田"
                >
            </div>

            <div class="form-group">
                <label for="address">住所</label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    value="{{ old('address') }}"
                    placeholder="例：東京都新宿区"
                >
            </div>

            <div class="form-group">
                <label for="genre">ジャンル</label>
                <input
                    type="text"
                    id="genre"
                    name="genre"
                    value="{{ old('genre') }}"
                    placeholder="例：ラーメン"
                >
            </div>

            <div class="form-group">
                <label for="description">説明</label>
                <textarea
                    id="description"
                    name="description"
                    placeholder="お店についての説明を書いてください"
                >{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">飲食店の画像</label>
                <input
                    type="file"
                    id="image"
                    name="image"
                    accept="image/*"
                >
            </div>

            <button type="submit">
                登録する
            </button>

        </form>

        <a class="back" href="{{ route('restaurants.index') }}">
            飲食店一覧に戻る
        </a>

    </div>

</div>

</body>
</html>




