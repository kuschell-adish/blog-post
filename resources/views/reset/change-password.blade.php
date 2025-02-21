@include('/components.header')
<body>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 ">
                <div class="p-6 space-y-3 md:space-y-2 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-emerald-600 ">
                        New Password
                    </h1>
                    <p class="text-xs text-gray-500 mt-1">Password must have at least 8 characters and must contain the following: uppercase letters, lowercase letters, numbers, and symbols.</p>
                    <form action="{{ route('password.update' )}}" method="POST" class="md:space-y-6">
                        @csrf
                        <input type="hidden" name="email" value="{{ request('email') }}">
                        <input type="hidden" name="token" value="{{ request('token') }}">
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your new password" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5">
                            @error('password')
                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-type your new password" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5">
                            @error('password_confirmation')
                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>