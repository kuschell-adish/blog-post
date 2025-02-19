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
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="mt-5 w-24 h-24 flex mx-auto justify-center items-center">
                            @if( Auth::user()->photo) 
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Photo" class="rounded-full">
                            @else 
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            @endif
                        </div>
                        <div class="sm:col-span-3 flex-column mt-8 ml-0">
                            <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Profile Photo</label>
                            <input id ="photo" type ="file" name="photo" class="rounded-md bg-white py-1.5 text-sm text-gray-900">
                            @error('photo')
                                <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First Name <span class="text-sm text-red-500">*</span></label>
                            <div class="mt-2">
                                <input type="text" name="first_name" id="first_name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ Auth::user()->first_name }}" >
                            </div>
                            @error('first_name')
                                <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last Name <span class="text-sm text-red-500">*</span></label>
                            <div class="mt-2">
                                <input type="text" name="last_name" id="last_name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ Auth::user()->last_name }}" >
                            </div>
                            @error('last_name')
                                <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username <span class="text-sm text-red-500">*</span></label>
                            <div class="mt-2">
                                <input type="text" name="username" id="username" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ Auth::user()->username }}" >
                            </div>
                            @error('username')
                                <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email <span class="text-sm text-red-500">*</span></label>
                            <div class="mt-2">
                                <input type="text" name="email" id="email" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ Auth::user()->email }}" >
                            </div>
                            @error('email')
                                <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="birthday" class="block text-sm font-medium leading-6 text-gray-900">Birthday <span class="text-sm text-red-500">*</span></label>
                            <div class="mt-2">
                                <input id="birthday" type="date" name="birthday" class="p-2 block w-full rounded-md border-0 py-[5px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" max="2005-12-31" required value="{{Auth::user()->birthday}}">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Age</label>
                            <div class="mt-2">
                                <div class="pl-2 block w-full bg-gray-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                                    <?php
                                    $birthday = new DateTime(Auth::user()->birthday);
                                    $today = new DateTime();
                                    $age = $today->diff($birthday)->y;
                                    echo $age . ' years old';
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">Gender <span class="text-sm text-red-500">*</span></label>
                            <div class="mt-2">
                                <select id="gender" name="gender" class="p-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                                    <option value="" {{ Auth::user()->gender == "" ? 'selected' : '' }}>Choose Gender</option>
                                    <option value="Male" {{ Auth::user()->gender == "Male" ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ Auth::user()->gender == "Female" ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Province <span class="text-sm text-red-500">*</span></label>
                            <div class="mt-2">
                                <select name="address" id="address" class="p-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province['code'] }}" {{ Auth::user()->address == $province['code'] ? 'selected' : '' }}>{{ $province['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('address')
                                <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
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