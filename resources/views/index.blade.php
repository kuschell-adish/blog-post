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

            <form action = "/add/blog" method="POST" enctype="multipart/form-data">
            @csrf
            @auth
            <div class="mt-10">
                <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author</label>
                <div class="mt-2 flex flex-row gap-x-2 ">
                    <img class="w-12 h-12 rounded-full" src="{{ asset('storage/' . Auth::user()->photo) ? asset('storage/' . Auth::user()->photo) : asset('storage/photo/default.jpg') }}" alt="Profile Picture" />
                    <input type="author" name="author" id="author" class="pl-2 block w-full  rounded-md  py-1.5 text-gray-900  sm:text-sm sm:leading-6" 
                    readonly value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                </div>
            </div>
            @endauth

            <div class="mt-10">
                <label for="cover_photo" class="block text-sm font-medium leading-6 text-gray-900 ">Cover Photo</label>
                <input id ="cover_photo" type ="file" name="cover_photo" class="rounded-md bg-white px-1 py-1.5 text-sm text-gray-900">
                @error('cover_photo')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
              </div>

            <div class="mt-10">
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                    <input type="text" name="title" id="title" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ old('title') }}">
                </div>
            </div>

            <div class="mt-10">
                <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Body <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                    <textarea id="body" name="body" rows="4" class="pl-2 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300" required>{{ old('body') }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" id="cancelButton" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Publish</button>
            </div>
        </form>
     </div>
</div>
</div>
</body>
</html>

<script>
    var cancelButton = document.getElementById("cancelButton");

    cancelButton.addEventListener("click", function(){
      document.getElementById("title").value = ""; 
      document.getElementById("body").value = ""; 
    });
</script>