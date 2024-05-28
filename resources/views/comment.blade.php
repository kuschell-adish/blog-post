<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="w-full p-10 bg-gray-50 flex flex-row">
    <section class="bg-teal-50 w-1/2 rounded-lg shadow p-5">
        <article class="p-6">
            <div class="flex justify-between items-center mb-5 text-gray-500">
                <div class="flex flex-row gap-x-3 flex-grow">
                    @php
                    $author = \App\Models\User::find($blog->author_id);
                    $profilePicture = $author ? $author->photo : null;
                    @endphp
                    <img class="w-7 h-7 rounded-full" src="{{ $profilePicture ? asset('storage/' . $profilePicture) : asset('storage/photo/default.jpg') }}" alt="{{ $profilePicture ? 'Profile Picture' : 'Default Profile Picture' }}" />
                    <span class="font-medium text-emerald-600">
                        {{$blog->author->first_name }} {{ $blog->author->last_name }}
                    </span>
                </div>
                <div>
                    <span class="text-sm ml-auto">{{ date('F d, Y', strtotime($blog->updated_at)) }}</span>
                </div>
            </div>
            <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 ">{{ $blog->title }}</h2>
            <p class="mb-5 font-light text-gray-500 ">{{ $blog->body }}</p>
        </article> 
    </section>
    <section class="bg-white w-1/2 py-8 lg:py-16 antialiased rounded-lg shadow">
        <div class="max-w-2xl mx-auto px-4">
                <p class="text-xl text-emerald-600 font-bold pb-7">Share your opinions 🙌🏼</p>
          <div class="mb-5">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Add Comment</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Comment field is required. </p>
          </div>
          <form action="{{ route('post.comment') }}" method="POST" class="mb-6">
            @csrf
            <input type="hidden" name="blog_id" value="{{ request()->input('blog_id') }}">
            <input type="hidden" name="author_id" value="{{ Auth::id() }}">
              <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                  <label for="comment" class="sr-only">Your comment</label>
                  <textarea name="comment"id="comment" rows="4"
                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                      placeholder="Write a comment..." required></textarea>
              </div>
              <button type="submit"
                  class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-emerald-600 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                  Post comment
              </button>
          </form>
          @foreach($comments as $comment)
           <h1>{{$comment->title}}</h1>
        <h2>{{$comment->body}}</h2>
          <article class="p-6 mb-3 text-base bg-white border-t border-emerald-200">
              <footer class="flex justify-between items-center mb-2">
                  <div class="flex items-center">
                    @php
                    $author = \App\Models\User::find($comment->author_id);
                    $profilePicture = $author ? $author->photo : null;
                    @endphp
                    <img class="w-7 h-7 rounded-full" src="{{ $profilePicture ? asset('storage/' . $profilePicture) : asset('storage/photo/default.jpg') }}" alt="{{ $profilePicture ? 'Profile Picture' : 'Default Profile Picture' }}" />
                      <p class="inline-flex items-center mr-3 text-sm text-gray-900 ml-2">{{$comment->author_name}}</p>
                      <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                              title="February 8th, 2022">{{date('F d, Y', strtotime($comment->updated_at))}}</time></p>
                  </div>
              </footer>
              <p class="text-gray-500 dark:text-gray-400">{{ $comment->comment }}</p>
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


