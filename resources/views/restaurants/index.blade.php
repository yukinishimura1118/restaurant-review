<x-layout title="飲食店一覧">
    <x-layout.single>

        <h1 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            飲食店一覧
        </h1>

        <form action="{{ route('restaurants.index') }}" method="GET">
            <input
                type="text"
                name="keyword"
                value="{{ request('keyword') }}"
                placeholder="店名を検索"
            >

            <select name="genre">
                <option value="">ジャンルを選択</option>

                <option value="ラーメン" {{ request('genre') == 'ラーメン' ? 'selected' : '' }}>
                    ラーメン
                </option>

                <option value="焼肉" {{ request('genre') == '焼肉' ? 'selected' : '' }}>
                    焼肉
                </option>

                <option value="寿司" {{ request('genre') == '寿司' ? 'selected' : '' }}>
                    寿司
                </option>

                <option value="和食" {{ request('genre') == '和食' ? 'selected' : '' }}>
                    和食
                </option>

                <option value="洋食" {{ request('genre') == '洋食' ? 'selected' : '' }}>
                    洋食
                </option>
            </select>

            <input
            type="text"
            name="address"
            value="{{ request('address') }}"
            placeholder="住所を検索"
             >

            <button type="submit">
                検索
            </button>
        </form>

        <div class="text-center mb-8">
            <a
                href="{{ route('restaurants.create') }}"
                class="inline-block bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600"
            >
                飲食店を登録する
            </a>
        </div>

        @forelse ($restaurants as $restaurant)

            <div class="bg-white rounded-md shadow-lg mb-6 p-6">

                {{-- 店名・店舗情報・画像 --}}
                <div class="flex justify-between items-start gap-6">

                    {{-- 左側：店舗情報 --}}
                    <div class="flex-1">

                        <h2 class="text-2xl font-bold mb-4">
                            <a
                                href="{{ route('restaurants.show', $restaurant) }}"
                                class="text-blue-500 hover:text-blue-700"
                            >
                                {{ $restaurant->name }}
                            </a>
                        </h2>

                        <p class="text-gray-600 mb-2">
                            住所：{{ $restaurant->address }}
                        </p>

                        <p class="text-gray-600 mb-2">
                            ジャンル：{{ $restaurant->genre }}
                        </p>

                        <p class="text-gray-700">
                            {{ $restaurant->description }}
                        </p>

                    </div>

                    {{-- 右側：画像 --}}
                    @if ($restaurant->image)
                        <div class="flex-shrink-0">
                            <img
                                src="{{ url('storage/' . $restaurant->image) }}"
                                alt="{{ $restaurant->name }}"
                                class="w-48 h-32 object-cover rounded-md"
                            >
                        </div>
                    @endif

                </div>

                {{-- レビュー --}}
                <div class="border-t border-gray-200 pt-4 mt-5">

                    <h3 class="text-xl font-bold mb-3">
                        レビュー
                    </h3>

                    @forelse ($restaurant->reviews as $review)

                        <div class="bg-gray-50 rounded-md p-4 mb-3">

                            <p class="text-yellow-500 font-bold">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </p>

                            <p class="text-gray-700 mt-2">
                                {{ $review->comment }}
                            </p>

                        </div>

                    @empty

                        <p class="text-gray-500">
                            まだレビューがありません。
                        </p>

                    @endforelse
{{-- 操作ボタン --}}
<div class="mt-4 flex items-center gap-4 leadingーnone">

    <a
        href="{{ route('restaurants.show', $restaurant) }}"
        class="text-blue-500 hover:text-blue-700 whitespace-nowrap"
    >
        詳細を見る
    </a>

    <a
        href="{{ route('reviews.create', $restaurant) }}"
        class="text-blue-500 hover:text-blue-700 whitespace-nowrap"
    >
        このお店にレビューを書く
    </a>

    <a
        href="{{ route('restaurants.edit', $restaurant) }}"
        class="text-green-600 hover:text-green-800 whitespace-nowrap"
    >
        編集
    </a>

    <form
        action="{{ route('restaurants.destroy', $restaurant) }}"
        method="POST"
        onsubmit="return confirm('この飲食店を削除しますか？');"
        class="inline-flex items-center my-0"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="bg-red-500 text-white text-xs px-2.5 py-1 rounded-md hover:bg-red-600 whitespace-nowrap"
        >
            削除
        </button>
    </form>

</div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-md shadow-lg p-6 text-center">

                <p class="text-gray-500">
                    まだ飲食店が登録されていません。
                </p>

            </div>

        @endforelse

    </x-layout.single>
</x-layout>

