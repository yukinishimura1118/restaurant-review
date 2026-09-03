<x-layout title="飲食店編集">
    <x-layout.single>

        <h1 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            飲食店を編集する
        </h1>

        <form
         action="{{ route('restaurants.update', $restaurant) }}"
         method="POST"
         enctype="multipart/form-data"
         >
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label
                    for="name"
                    class="block text-gray-700 font-bold mb-2"
                >
                    店名
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $restaurant->name) }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2"
                >

                @error('name')
                    <p class="text-red-500 mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-5">
                <label
                    for="address"
                    class="block text-gray-700 font-bold mb-2"
                >
                    住所
                </label>

                <input
                    type="text"
                    id="address"
                    name="address"
                    value="{{ old('address', $restaurant->address) }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2"
                >

                @error('address')
                    <p class="text-red-500 mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-5">
                <label
                    for="genre"
                    class="block text-gray-700 font-bold mb-2"
                >
                    ジャンル
                </label>

                <input
                    type="text"
                    id="genre"
                    name="genre"
                    value="{{ old('genre', $restaurant->genre) }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2"
                >

                @error('genre')
                    <p class="text-red-500 mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-5">
                <label
                    for="description"
                    class="block text-gray-700 font-bold mb-2"
                >
                    説明
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    class="w-full border border-gray-300 rounded-md px-4 py-2"
                >{{ old('description', $restaurant->description) }}</textarea>

                @error('description')
                　<p class="text-red-500 mt-1">
                    {{ $message }}
                　　</p>
                @enderror
            </div>
                　
                <div class="mb-5">
                    <label
                        for="image"
                        class="block text-gray-700 font-bold mb-2"
                    >
                        飲食店の画像
                    </label>

                    @if ($restaurant->image)
                        <img
                            src="{{ url('storage/' . $restaurant->image) }}"
                            alt="{{ $restaurant->name }}"
                            class="w-48 h-32 object-cover rounded-md mb-3"
                        >
                    @endif

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="w-full border border-gray-300 rounded-md px-4 py-2"
                    >
                </div>


            <div class="flex items-center gap-4">

                <button
                    type="submit"
                    class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600"
                >
                    更新する
                </button>

                <a
                    href="{{ route('restaurants.index') }}"
                    class="text-gray-500 hover:text-gray-700"
                >
                    戻る
                </a>

            </div>

        </form>

    </x-layout.single>
</x-layout>

