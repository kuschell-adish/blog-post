@include('/components.header')
<body class="bg-gray-50">
    <section class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="bg-white rounded-lg shadow-lg p-4 sm:p-2">
                <div class="p-6 space-y-3 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold text-emerald-600 mb-4">
                        Forgot Password? 
                    </h1>
                    <p class="text-xs text-gray-500">Enter the email address registered to your account and we will send you a link to reset your password.</p>
                    <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email address" required class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-emerald-600 focus:border-emerald-600">
                            @error('email')
                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg px-5 py-2.5 text-sm text-center">Send Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>