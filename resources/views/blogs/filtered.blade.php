@include('/components.header')
<body class="bg-gray-50">
    <div>
        @include('/components.sidebar')
    </div>
    <div class="p-4 sm:ml-64">
        @include('/components.messages')
        <div class="bg-white rounded-lg p-10 shadow">
            <div class="pb-10">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Published Blogs</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">These are all the blogs that you have produced. </p>
            </div>
            <div class="grid gap-8 lg:grid-cols-2">
                @foreach ($blogs as $blog)
                    <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md ">
                        <div class="flex flex-row justify-between items-center space-x-4 mb-5">
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
                                <span class="text-sm ml-auto">{{ date('F d, Y', strtotime($blog->updated_at)) }}</span>
                            </div>
                        </div>
                        <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 ">{{ $blog->title }}</h2>
                        <p class="mb-5 font-light text-gray-500 ">{{ $blog->body }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('comments.index', ['blog_id' => $blog->id]) }}" class="font-medium text-sm text-sky-600 hover:underline">Read More > </a>
                            <div class="flex justify-end gap-x-2">
                                <a class="bg-cyan-600 hover:bg-sky-800 text-xs text-white font-bold rounded-full p-2 px-4 text-center" href="{{ route('blogs.show', ['blog' => $blog->id])}}">
                                    Edit
                                </a>
                                <form action ="{{ route('blogs.destroy', ['blog' => $blog->id])}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <div>
                                        <button onclick="confirmation(event)" type ="submit" class="p-2 px-3 text-center bg-red-700 rounded-full text-white font-bold text-xs hover:bg-red-900">
                                            Delete
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </article> 
                @endforeach
            </div>
        </div>
    </div> 
</body>
</html>