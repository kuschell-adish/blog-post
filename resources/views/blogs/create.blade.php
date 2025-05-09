@include('/components.header')
<body class="bg-gray-50">
    <div>
        @include('/components.sidebar')
    </div>
    <div class="p-4 sm:ml-64">
        <div class="bg-white rounded-lg p-10 shadow">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Create Blog</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">All fields are required. </p>
                <form action = "{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-8">
                        <label for="cover_photo" class="block text-sm font-medium leading-6 text-gray-900 ">Cover Photo</label>
                        <div class="max-w-sm mb-4">
                            <img id="photo_preview" src="#" alt="Selected Image Preview" class="hidden w-80 h-auto rounded-lg">
                        </div>
                        <div class="max-w-sm">
                            <label class="block">
                              <input id="cover_photo" name="cover_photo" type="file" accept="image/png, image/jpeg, image/jpg" class="block w-full text-sm text-gray-500 mt-2
                                file:me-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-emerald-600 file:text-white
                                hover:file:bg-emerald-700
                                file:disabled:opacity-50 file:disabled:pointer-events-none"
                                onchange="previewPhoto(event)">
                            </label>
                        </div>
                        @error('cover_photo')
                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-8">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ old('title') }}">
                        </div>
                        @error('title')
                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-8">
                        <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Body</label>
                        <div class="mt-2">
                            <textarea id="body" name="body" rows="4" class="pl-2 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300" required>{{ old('body') }}</textarea>
                        </div>
                        @error('body')
                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                        @enderror
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
        document.getElementById("cover_photo").value = null; 
        document.getElementById("title").value = null; 
        document.getElementById("body").value = null; 
    });

    function previewPhoto(event) {
        const input = event.target;
        const preview = document.getElementById('photo_preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>