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
        <p class="text-xl text-emerald-600 font-bold pb-7">Begin your blogging journey today ✍🏼</p>
        <div>
            <h2 class="text-base font-semibold leading-7 text-gray-900">Create Blog</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">All fields are required. </p>

            <form action = "/add/blog" method="POST">
            @csrf
            @auth
            <div class="mt-10">
                <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author</label>
                <div class="mt-2">
                    <input type="author" name="author" id="author" class="pl-2 block w-full bg-gray-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" 
                    readonly value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                </div>
            </div>
        @endauth

            <div class="mt-10">
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                <div class="mt-2">
                    <input type="text" name="title" id="title" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" value="{{ old('title') }}">
                </div>
            </div>

            <div class="mt-10">
                <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Body</label>
                <div class="mt-2">
                    <textarea id="body" name="body" rows="4" class="pl-2 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Publish</button>
            </div>
        </form>
     </div>
</div>
</div>
</body>
</html>