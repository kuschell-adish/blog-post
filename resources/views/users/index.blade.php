@include('/components.header')
    <body class="bg-gray-50">
        <div>
        @include('/components.sidebar')
        </div>
        <div class="p-4 sm:ml-64">
            @include('/components.messages')
            <div class="bg-white rounded-lg p-10 shadow">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Your Profile</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Here are all your basic information. </p>
                    <form action="{{ route('users.update', ['user' => $user->id])}}" method="POST" enctype="multipart/form-data">
                        @auth
                        @csrf
                        @method('PUT')
                        <div class="mt-10 grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-8">
                            <div class="sm:col-span-3 flex flex-col items-center justify-center">
                                <div class="flex flex-col items-center justify-center">
                                    @if($user->photo)
                                        <img id="photo_preview" src="{{ $user->photo }}" alt="Profile Photo" class="rounded-full w-24 h-24 object-cover">
                                    @endif

                                    <div class="mt-4 ml-12 w-full max-w-xs">
                                        <label class="block">
                                            <input id="photo" name="photo" type="file" accept="image/png, image/jpeg, image/jpg"
                                            class="block mx-auto text-sm text-gray-500
                                            file:py-2 file:px-4
                                            file:rounded-lg file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-emerald-600 file:text-white
                                            hover:file:bg-emerald-700
                                            file:disabled:opacity-50 file:disabled:pointer-events-none"
                                            onchange="previewPhoto(event)" />
                                        </label>
                                        @error('photo')
                                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div class="sm:col-span-3 flex flex-col gap-6 justify-center">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First Name <span class="text-sm text-red-500">*</span></label>
                                    <input type="text" name="first_name" id="first_name" required
                                        class="mt-2 p-2 block w-full rounded-md border border-gray-300 text-gray-900 shadow-sm sm:text-sm"
                                        value="{{ $user->first_name }}" />
                                    @error('first_name')
                                        <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                        
                                <div>
                                    <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last Name <span class="text-sm text-red-500">*</span></label>
                                    <input type="text" name="last_name" id="last_name" required
                                        class="mt-2 p-2 block w-full rounded-md border border-gray-300 text-gray-900 shadow-sm sm:text-sm"
                                        value="{{  $user->last_name  }}" />
                                    @error('last_name')
                                        <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                        
                                <div>
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email <span class="text-sm text-red-500">*</span></label>
                                    <input type="text" name="email" id="email" required
                                        class="mt-2 p-2 block w-full rounded-md border border-gray-300 text-gray-900 shadow-sm sm:text-sm"
                                        value="{{  $user->email  }}" />
                                    @error('email')
                                        <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            @endauth
                        </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
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