<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
    <div class="w-full p-10 bg-gray-50">
        <div class="bg-white rounded-lg p-10 shadow">
            <p class="text-xl text-emerald-600 font-bold pb-7">Begin your blogging journey today ✍🏼</p>
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Comment</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">All fields are required. </p>
    
                <form action = "/comment/{{$comment->id}}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="author_id" value="{{ Auth::id() }}">
                <div class="mt-10">
                    <label for="comment" class="block text-sm font-medium leading-6 text-gray-900">Comment</label>
                    <div class="mt-2">
                        <textarea id="comment" name="comment" rows="4" class="pl-2 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{$comment->comment}}</textarea>
                    </div>
                </div>
    
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="/view/blogs" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Update</button>
                </div>
            </form>
         </div>
    </div>
    </div>
</body>
</html>