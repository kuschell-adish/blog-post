<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="w-full p-10 bg-gray-50 flex flex-row">
    <section class="bg-white w-1/2 rounded-l-lg shadow p-5">
        <article class="p-6">
            <div class="flex justify-between items-center mb-5 text-gray-500">
                <div class="flex flex-row gap-x-3 flex-grow">
                      <img class="w-7 h-7 rounded-full" src="{{ asset('storage/' . $blog->author->photo) ? asset('storage/' . $blog->author->photo) : asset('storage/photo/default.jpg') }}" alt="Profile Picture" />
                    <span class="font-medium text-emerald-600">
                        {{$blog->author->first_name }} {{ $blog->author->last_name }}
                    </span>
                </div>
                <div>
                    <span class="text-sm ml-auto">{{ date('F d, Y', strtotime($blog->updated_at)) }}</span>
                </div>
            </div>
            <div class="w-full h-1/2 mb-5">
                <img src="{{asset('storage/' . $blog->cover_photo) ? asset('storage/' . $blog->cover_photo) : asset('storage/photo/cover.jpg') }}" alt="Cover Photo"class="w-full h-full object-cover rounded">
            </div>
            <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 ">{{ $blog->title }}</h2>
            <p class="mb-5 font-light text-gray-500 text-justify">{{ $blog->body }}</p>
        </article> 
    </section>
    <section class="bg-stone-50 w-1/2 py-8 lg:py-16 antialiased rounded-r-lg shadow">
        <div class="max-w-2xl mx-auto px-4">
                <p class="text-xl text-emerald-600 font-bold pb-7">Share your opinions 🙌🏼</p>
          <form action="/post/comment" method="POST" class="mb-6">
            @csrf
            <input type="hidden" name="blog_id" value="{{ request()->input('blog_id') }}">
            <input type="hidden" name="author_id" value="{{ Auth::id() }}">
            <p class="text-xs text-emerald-800 my-2"> Comment as {{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
              <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                  <textarea name="comment"id="comment" rows="4"
                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                      placeholder="Write a comment..." required></textarea>
              </div>
              <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" id="cancelButton" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Post</button>
            </div>
          </form>
          <div class="border-t border-emerald-200"></div>
          @foreach($comments as $comment)
           <h1>{{$comment->title}}</h1>
        <h2>{{$comment->body}}</h2>
          <article class="p-6 mb-3 text-base border-b border-emerald-200">
              <footer class="flex justify-between items-center mb-2">
                  <div class="flex items-center">
                    <img class="w-7 h-7 rounded-full" src="{{ asset('storage/' . $comment->author->photo) ? asset('storage/' . $comment->author->photo) : asset('storage/photo/default.jpg') }}" alt="Profile Picture" />
                      <p class="inline-flex items-center mr-3 text-sm text-gray-900 ml-2">{{$comment->author->first_name}} {{$comment->author->last_name}}</p>
                      <p class="text-sm text-gray-600 ">{{date('F d, Y', strtotime($comment->updated_at))}}</p>
                  </div>
              </footer>
              <p class="text-xs pl-9 pt-2 text-gray-700">{{ $comment->comment }}</p>
              @if($user->id === $comment->author_id)
              <div class="flex justify-end gap-x-2">
                    <a class="bg-cyan-600 hover:bg-sky-800 text-xs text-white font-bold rounded-full p-2 px-4 text-center" href="/comment/{{$comment->id}}">
                        Edit
                    </a>
                    <form action ="/comment/{{$comment->id}}" method="POST">
                        @method('delete')
                        @csrf
                        <div>
                            <button onclick="confirmation(event)" type ="submit" class="p-2 px-3 text-center bg-red-700 rounded-full text-white font-bold text-xs hover:bg-red-900">
                                Delete
                            </button>
                        </div>
                    </form>
            </div>
            @elseif($user->id === $blog->author_id)
            <div class="flex justify-end gap-x-2">
                <form action ="/comment/{{$comment->id}}" method="POST">
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


