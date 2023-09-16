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
                    {{ ('投稿記事') }}
                    {{ $user->name }}
                    @foreach($articleList as $articles)
                    {{ $articles->title }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
