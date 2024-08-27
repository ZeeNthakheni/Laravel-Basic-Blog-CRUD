<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
                        @csrf
                        @method('patch')
                        <p class="pb-4">{{ __("Post Title") }}</p>
                        <input 
                        type="text" 
                        id="title" 
                        name="title"
                        required
                        maxlength="255"
                        value="{{ $post->title }}"
                        placeholder="{{ __('Enter Your Cool Title Here') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        >
                        <x-input-error :messages="$errors->store->get('title')" class="mt-2" />
                            <br/>
                        <p class="pb-4">{{ __("Post Conent") }}</p>
                        <textarea
                            id="content" 
                            required
                            name="content"
                            placeholder="{{ __('What\'s on your mind?') }}"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        >{{ $post->content }}</textarea>
                        <x-input-error :messages="$errors->store->get('content')" class="mt-2" />
                        <x-primary-button class="mt-4">{{ __('Edit Post') }}</x-primary-button>
                        <x-primary-button class="mt-4" onclick="history.go(-1);">{{ __('Back') }}</x-primary-button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
