@include('/components.header')
<body class="bg-gray-50">
    <section class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="bg-white rounded-lg shadow-lg p-4 sm:p-2">
                <div class="p-6 space-y-3 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold text-emerald-600 mb-4">
                        New Password
                    </h1>
                    <p class="text-xs text-gray-500 mt-1">Password must have at least 8 characters and must contain the following: uppercase letters, lowercase letters, numbers, and symbols.</p>
                    <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="email" value="{{ request('email') }}">
                        <input type="hidden" name="token" value="{{ request('token') }}">
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your new password" required class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-emerald-600 focus:border-emerald-600">
                            @error('password')
                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-type your new password" required class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-emerald-600 focus:border-emerald-600">
                            @error('password_confirmation')
                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg px-5 py-2.5 text-sm text-center">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>