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
            <h2 class="text-base font-semibold leading-7 text-gray-900">Your Profile</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Here are all your basic information. </p>

            <form action="/user/{{ $user->id }}" method="POST" enctype="multipart/form-data">
            @auth
            @csrf
            @method('PUT')
            <div class="w-2/12 h-2/12 flex mx-auto justify-center items-center">
                @if( Auth::user()->photo) 
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile photo" class="mb-4 rounded-full">
                
                @else 
                    <img src="{{ asset('storage/photo/default.jpg') }}" alt="Default Image" class="mb-4 rounded-full">
                @endif
            </div>

            <div class="mt-5">
                 <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Profile Photo</label>
                 <input id ="photo" type ="file" name="photo" class="rounded-md bg-white py-1.5 text-sm font-semibold text-gray-900">
                @error('photo')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First Name <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input type="text" name="first_name" id="first_name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ Auth::user()->first_name }}" >
                </div>
                @error('first_name')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last Name <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input type="text" name="last_name" id="last_name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ Auth::user()->last_name }}" >
                </div>
                @error('last_name')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input type="text" name="username" id="username" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ Auth::user()->username }}" >
                </div>
                @error('username')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input type="text" name="email" id="email" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ Auth::user()->email }}" >
                </div>
                @error('email')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label for="birthday" class="block text-sm font-medium leading-6 text-gray-900">Birthday <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input id="birthday" type="date" name="birthday" class="p-2 block w-full rounded-md border-0 py-[5px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" max="2005-12-31" required value="{{Auth::user()->birthday}}">
                </div>
            </div>

            <div class="mt-5">
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

            <div class="mt-5">
                <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">Gender <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                    <select id="gender" name="gender" class="p-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        <option value="" {{ Auth::user()->gender == "" ? 'selected' : '' }}>Choose Gender</option>
                        <option value="Male" {{ Auth::user()->gender == "Male" ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ Auth::user()->gender == "Female" ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>

            <div class="mt-5">
                <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input type="text" name="address" id="address" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{ Auth::user()->address }}" >
                </div>
                @error('address')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
            </div>
        @endauth

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Update</button>
          </div>
     </div>
    </form>
</div>
</div>
</body>
</html>