<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('投稿記事') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ ('投稿記事一覧') }}
                    <ul class="list-group list-group-flush" style="width: 70%;">
                        @foreach($articleList as $articles)

                        <li class="list-group-item">
                            <p><a href="{{ route('articleView', ['id' => $articles->id]) }}">{{ $articles->title }}</a></p>
                            <p>投稿日:{{ $articles->created_at->format('Y-m-d') }}</p>
                        </li>
                        @endforeach
                        <br>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>