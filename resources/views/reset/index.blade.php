@include('/components.header')
<body>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 ">
                <div class="p-6 space-y-3 md:space-y-2 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-emerald-600 ">
                        Forgot Password? 
                    </h1>
                    <p class="text-xs text-gray-500">Enter the email address registered to your account and we will send you a link to reset your password.</p>
                    <form action="{{ route('password.email' )}}" method="POST" class="md:space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email address" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block w-full p-2.5">
                            @error('email')
                            <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Send Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>