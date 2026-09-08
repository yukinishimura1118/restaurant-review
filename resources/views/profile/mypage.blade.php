<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            マイページ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="text-2xl font-bold mb-4">
                        マイページ
                    </h1>

                    <p>
                        ユーザー名：{{ $user->name }}
                    </p>

                    <p>
                        メールアドレス：{{ $user->email }}
                    </p>

                    <hr class="my-6">

                  <h2 class="text-xl font-bold mb-4">
                    自分のレビュー
                  </h2>

                @forelse ($reviews as $review)
                <div class="border-b py-4">
                 <h3 class="font-bold">
                 {{ $review->restaurant->name }}
                 </h3>

                 <p>
                  評価：{{ $review->rating }} / 5
                </p>

                <p>
                {{ $review->comment }}
                </p>
                <div class="mt-2">
                    <a href="{{ route('reviews.edit', $review) }}"
                       class="text-blue-500 hover:underline">
                        レビューを編集
                    </a>

                    <form action="{{ route('reviews.destroy', $review) }}"
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="text-red-500 hover:underline ml-4"
                                onclick="return confirm('このレビューを削除しますか？')">
                            レビューを削除
                        </button>
                    </form>
                </div>
         </div>
      @empty
        <p>
        まだレビューを投稿していません。
         </p>
     @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
