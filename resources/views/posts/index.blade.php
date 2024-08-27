<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome back!") }}
                    </br>
                    </br>
                    <div>
                        <a class="btn btn-primary" role="button" href="{{ route('posts.create') }}" >Create Post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="pb-4">{{ __("Browse the latest posts!") }}</p>
                    @if (count($posts) > 0)
                        @foreach ($posts as $post)
                            <div class="row mb-2">
                                <div class="col-md-12">
                                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                    <div class="col p-4 d-flex flex-column position-static">
                                        <strong class="d-inline-block mb-2 text-primary">By Author: {{ $post->user->name }}</strong>
                                        <div class="mb-1 text-muted">{{ $post->created_at->format('j M Y, g:i a') }}</div>
                                        <p class="card-text mb-auto">{{ $post->title }}</p>
                                        <div class="flex">
                                            <div class="">
                                                <a class="btn btn-primary" href="{{ route('posts.show', ['post' => $post->id]) }}" class="stretched-link">Continue reading</a>
                                            </div>
                                            @if ($post->user->is(auth()->user()))
                                                <div class="px-2">
                                                    <a class="btn btn-success" href="{{ route('posts.edit', ['post' => $post->id]) }}" class="stretched-link">Edit post</a>
                                                </div>
                                                <div class="px-1">
                                                    <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger" href="" class="stretched-link">Delete</button>
                                                    </form>
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
