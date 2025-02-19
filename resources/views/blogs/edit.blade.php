@include('/components.header')
<body class="bg-gray-50">
    <div class="w-full p-10">
        <div class="bg-white rounded-lg p-10 shadow">
            <p class="text-xl text-emerald-600 font-bold pb-7">Begin your blogging journey today ✍🏼</p>
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Blog</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">All fields are required. </p>
    
                <form action = "{{ route('blogs.update', ['blog' => $blog->id])}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mt-10">
                        <label for="cover_photo" class="block text-sm font-medium leading-6 text-gray-900 ">Cover Photo</label>
                        <div class="mt-2 flex flex-col items-center justify-center">
                        <img src="{{ asset('storage/' . $blog->cover_photo) ? asset('storage/' .$blog->cover_photo) : asset('storage/photo/cover.jpg') }}" class="w-full h-60 object-contain">
                        <input id ="cover_photo" type ="file" name="cover_photo" class="mt-4 rounded-md bg-white px-1 py-1.5 text-sm font-semibold text-gray-900">
                        </div>
                        @error('cover_photo')
                        <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    @auth
                        <div class="mt-5">
                            <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author</label>
                            <div class="mt-2 flex flex-row gap-x-2 ">
                                <img class="w-16 h-16 rounded-full" src="{{ asset('storage/' . Auth::user()->photo) ? asset('storage/' . Auth::user()->photo) : asset('storage/photo/default.jpg') }}" alt="Profile Picture" />
                                <input type="author" name="author" id="author" class="pl-2 block w-full  rounded-md  py-1.5 text-gray-900  sm:text-sm sm:leading-6" 
                                readonly value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                            </div>
                        </div>
                    @endauth
                    <div class="mt-10">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" value="{{$blog->title}}">
                        </div>
                    </div>
                    <div class="mt-10">
                        <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Body</label>
                        <div class="mt-2">
                            <textarea id="body" name="body" rows="6" class="pl-2 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{$blog->body}}</textarea>
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