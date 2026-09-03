

@props([
    'tweets' => []
])
<div class="bg-white rounded-md shadow-lg mt-5 mb-5">
    <ul>
        @foreach($tweets as $tweet)
        <li class="border-b last:border-b-0 border-gray-200 p-4 flex
        items-start justify-between">
        <div>
            <span class="inline-block rounded-full text-gray-600
            bg-gray-100 px-2 py-1 text-xs mb-2">
            {{ $tweet->user->name}}
        </span>
        <p class="text-gray-600">{!! nl2br(e($tweet->content)) !!}</p>
        <x-tweet.images :images="$tweet->images"/>
            <form method="POST" action="{{ route('tweet.like', $tweet) }}">
                @csrf

                <button type="submit" class="text-red-500 font-bold">
                    @if ($tweet->likes->where('user_id', auth()->id())->count())
                        ♥ いいね
                    @else
                        ♡ いいね
                    @endif
                </button>

                <span>
                    {{ $tweet->likes->count() }}
                </span>
            </form>
            <form method="POST" action="{{ route('tweet.like', $tweet) }}">
                @csrf

                <button type="submit" class="text-red-500 font-bold">
                    @if ($tweet->likes->where('user_id', auth()->id())->count())
                        ♥ いいね
                    @else
                        ♡ いいね
                    @endif
                </button>

                <span>
                    {{ $tweet->likes->count() }}
                </span>
            </form>
        </div>
        <div>
            <!-- TODO編集と削除　-->

            <x-tweet.options :tweetId="$tweet->id" :userId="$tweet->user_id">
            </x-tweet.options>
            <form method="POST" action="{{ route('tweet.like', $tweet) }}" class="mt-2">
                @csrf

                <button type="submit" class="text-red-500 font-bold">
                    ♡ {{ $tweet->likes->count() }}
                </button>
            </form>
        </div>

        </li>
        @endforeach
    </ul>
</div>
