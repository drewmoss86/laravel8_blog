@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
      <div class="w-8/12 bg-white p-6 rounded-lg">
        <form action="{{ route('post') }}" method="post" class="mb-4">
          @csrf
          <div class="mb-4">
            <label for="body" class="sr-only"></label>
            <textarea name="body" id="" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body')
              border-red-500 @enderror" placeholder="Your post..."></textarea>
            
              @error('body')
                  <div class="text-red-500 mt-2 text-small">
                    {{ $message }}
                  </div>
              @enderror  
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-font-medium">Post</button>
        </form>

        <div>
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mb=4">
                        <a href="" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        <p class="mb-2">{{ $post->body }}</p>

                        <div>
                            <form action="{{ route('post.destroy', $post) }}" method="post" class="mr-1">
                                @csrf
                                @method('DELETE') {{-- Method spoofing since no 'delete' method --}}
                                <button type="submit" class="text-blue-500">Delete</button>
                            </form>       
                        </div>

                        <div class="flex items-center">
                            @auth
                                @if (!$post->likedBy(auth()->user()))
                                    <form action="{{ route('likes', $post) }}" method="post" class="mr-1">
                                        @csrf
                                        <button type="submit" class="text-blue-500">Like</button>
                                    </form>                              
                                @else
                                    <form action="{{ route('likes', $post) }}" method="post" class="mr-1">
                                        @csrf
                                        @method('DELETE') {{-- Method spoofing since no 'delete' method --}}
                                        <button type="submit" class="text-blue-500">Dislike</button>
                                    </form>                              
                                @endif                                        
                            @endauth
                    
                            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                            {{-- @if ($liked)
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <span class="block sm:inline">You already liked this!</span>
                                </div>
                            @endif --}}
                            
                        </div>                         
                    </div>
                @endforeach 

                {{ $posts->links() }}
            @else
                <p>You have not posted anything yet!</p>
            @endif
        </div>
      </div>
    </div>
@endsection
