@include('/components.header')
<body class="w-full bg-gray-50 p-4 sm:p-10 gap-4">
    <section class="bg-white max-w-5xl rounded-lg shadow p-5 mx-auto">
        @include('/components.messages')
        <article class="p-6">
            <div class="flex justify-between items-center mb-5">
                <div class="flex flex-row items-center gap-x-2 flex-grow">
                    @if( $blog->user->photo ) 
                        <img class="w-7 h-7 rounded-full" src="{{ $blog->user->photo }}" alt="Profile Picture" />
                    @else 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>
                    @endif
                    <span class="font-medium text-emerald-600">
                        {{ $blog->user->first_name }} {{ $blog->user->last_name }}
                    </span>
                </div>
                <div>
                    <span class="text-sm ml-auto text-gray-500">{{ date('F d, Y', strtotime($blog->updated_at)) }}</span>
                </div>
            </div>
            <div class="w-full h-1/2 mb-5">
                @if($blog->cover_photo) 
                    <img src="{{ $blog->cover_photo }}" alt="Cover Photo" class="w-full h-full object-cover rounded">
                @else 
                    <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-32">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                @endif
            </div>
            <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 ">{{ $blog->title }}</h2>
            <p class="font-light text-gray-500 text-justify">{{ $blog->body }}</p>
        </article> 
        <div class="p-6">
            <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                @csrf
                <input type="hidden" name="blog_id" value="{{ request()->input('blog_id') }}">
                <p class="text-xs text-emerald-800 my-2"> Comment as {{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                <div class="py-2 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                    <textarea name="comment" id="comment" rows="4"
                        class="w-full px-4 py-2 text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                        placeholder="Write a comment..." required></textarea>
                </div>                
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" id="cancelButton" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Post</button>
                </div>
            </form>
            @foreach($comments as $comment)
                <h1>{{$comment->title}}</h1>
                <h2>{{$comment->body}}</h2>
                <article class="p-6 mb-3 text-base border-b border-emerald-200">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            @if( $comment->user->photo ) 
                                <img class="w-7 h-7 rounded-full" src="{{ asset('storage/' . $comment->user->photo) }}" alt="Profile Picture" />
                            @else 
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                                </svg>
                            @endif
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 ml-2">{{$comment->user->first_name}} {{$comment->user->last_name}}</p>
                            <p class="text-sm text-gray-600 ">{{date('F d, Y', strtotime($comment->updated_at))}}</p>
                        </div>
                     </footer>
                    <p class="text-xs pl-9 pt-2 text-gray-700">{{ $comment->comment }}</p>
                    @if($user->id === $comment->user_id)
                        <div class="flex justify-end gap-x-2">
                            <a class="bg-cyan-600 hover:bg-sky-800 text-xs text-white font-bold rounded-full p-2 px-4 text-center" href="{{ route('comments.update', ['comment' => $comment->id])}}">
                                Edit
                            </a>
                            <form action ="{{ route('comments.destroy', ['comment' => $comment->id])}}" method="POST">
                                @method('delete')
                                @csrf
                                <div>
                                    <button onclick="confirmation(event)" type ="submit" class="p-2 px-3 text-center bg-red-700 rounded-full text-white font-bold text-xs hover:bg-red-900">
                                        Delete
                                    </button>
                                </div>
                            </form>
                        </div>
                    @elseif($user->id === $blog->user)
                        <div class="flex justify-end gap-x-2">
                            <form action ="{{ route('comments.destroy', ['comment' => $comment->id])}}" method="POST">
                                @method('delete')
                                @csrf
                                <div>
                                    <button onclick="confirmation(event)" type ="submit" class="p-2 px-3 text-center bg-red-700 rounded-full text-white font-bold text-xs hover:bg-red-900">
                                        Delete
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    </section>
</body>
</html>

<script>
    var cancelButton = document.getElementById("cancelButton");
    
    cancelButton.addEventListener("click", function(){
          document.getElementById("comment").value = ""; 
    });
</script>


