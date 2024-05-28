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

            @auth
            <div class="w-2/12 h-2/12 flex mx-auto justify-center items-center">
                @if( Auth::user()->photo) 
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile photo" class="mb-4 rounded-full">
                
                @else 
                    <img src="{{ asset('storage/photo/default.jpg') }}" alt="Default Image" class="mb-4 rounded-full">
                
                @endif
            </div>

            <div class="mt-5">
                <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                <div class="mt-2">
                    <div class="pl-2 block w-full bg-gray-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                <div class="mt-2">
                    <div class="pl-2 block w-full bg-gray-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        {{ Auth::user()->username }}
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    <div class="pl-2 block w-full bg-gray-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        {{ Auth::user()->email }}
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Birthday</label>
                <div class="mt-2">
                    <div class="pl-2 block w-full bg-gray-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        {{ date('F d, Y', strtotime(Auth::user()->birthday)) }}
                    </div>
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
                <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
                <div class="mt-2">
                    <div class="pl-2 block w-full bg-gray-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        {{ Auth::user()->gender }}
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                <div class="mt-2">
                    <div class="pl-2 block w-full bg-gray-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        {{ Auth::user()->address }}
                    </div>
                </div>
            </div>
        @endauth
     </div>
</div>
</div>
</body>
</html>