<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
<div>
    @include('/components.nav')
</div>
<div class="p-4 sm:ml-64 bg-gray-50">
    <div class="bg-white rounded-lg p-10 shadow">
        <p class="text-xl text-emerald-600 font-bold pb-7">Your daily dose of blog brilliance ✨</p>
        <div class="pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Published Blogs</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">These are all the blogs that you have produced. </p>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            @foreach ($blogs as $blog)
            <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md ">
                <div class="flex flex-row justify-between items-center space-x-4 mb-5">
                    <div class="flex flex-row gap-x-3 flex-grow">
                        @php
                        $author = \App\Models\User::find($blog->author_id);
                        $profilePicture = $author ? $author->photo : null;
                        @endphp
                        <img class="w-7 h-7 rounded-full" src="{{ $profilePicture ? asset('storage/' . $profilePicture) : asset('storage/photo/default.jpg') }}" alt="{{ $profilePicture ? 'Profile Picture' : 'Default Profile Picture' }}" />
                        <span class="font-medium text-emerald-600">
                            {{ $blog->author_name }}
                        </span>
                    </div>
                    <div>
                        <span class="text-sm ml-auto">{{ date('F d, Y', strtotime($blog->updated_at)) }}</span>
                    </div>
                </div>
                <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 ">{{ $blog->title }}</h2>
                <p class="mb-5 font-light text-gray-500 ">{{ $blog->body }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('comment', ['blog_id' => $blog->id]) }}" class="font-medium text-sm text-sky-600 hover:underline">Read More > </a>
                        <div class="flex justify-end gap-x-2">
                            <a class="bg-cyan-600 hover:bg-sky-800 text-xs text-white font-bold rounded-full p-2 px-4 text-center" href="/blog/{{$blog->id}}">
                                Edit
                            </a>
                            <form action ="/blog/{{$blog->id}}" method="POST">
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