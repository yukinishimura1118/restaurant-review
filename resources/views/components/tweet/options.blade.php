@props([
    'tweetId',
    'userId',
])

<details class="tweet-option relative text-gray-500">

    <summary>
        ⋮
    </summary>

    <div class="bg-white rounded shadow-md absolute right-0 w-24 z-20 pt-1 pb-1">

        {{-- 編集 --}}
        <div>
            <a href="{{ route('tweet.update.index', ['tweetId' => $tweetId]) }}"
               class="block pt-1 pb-1 pl-3 pr-3 hover:bg-gray-100">
                編集
            </a>
        </div>

        {{-- 削除 --}}
        <div>
            <form action="{{ route('tweet.delete', ['tweetId' => $tweetId]) }}"
                  method="POST"
                  onsubmit="return confirm('削除してもよろしいですか？');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="block w-full text-left pt-1 pb-1 pl-3 pr-3 hover:bg-gray-100">
                    削除
                </button>

            </form>
        </div>

    </div>

</details>



