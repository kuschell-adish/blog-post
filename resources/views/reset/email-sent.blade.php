@include('/components.header')
<body>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 ">
                <div class="p-6 space-y-3 md:space-y-2 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-emerald-600 ">
                        Email Sent! 
                    </h1>
                    <p class="text-xs text-gray-500">We have successfully sent you an email with instructions on how to reset your password. Kindly check your inbox or spam folder.</p>
                </div>
                <div>
                    <p class="text-sm font-light text-gray-500 px-8 py-5">
                        Did not receive an email? <a href="{{ route('password.index' )}}" class="font-medium text-emerald-600 hover:underline">Resend Email</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>