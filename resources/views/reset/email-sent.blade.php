@include('/components.header')
<body class="bg-gray-50">
    <section class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="bg-white rounded-lg shadow-lg p-4 sm:p-2">
                <div class="p-6 space-y-3 md:space-y-2 sm:p-8">
                    <h1 class="text-xl font-bold text-emerald-600 mb-4">
                        Email Sent! 
                    </h1>
                    <p class="text-xs text-gray-500">We have successfully sent you an email with instructions on how to reset your password. Kindly check your inbox or spam folder.</p>
                </div>
                <div>
                    <p class="text-sm font-light text-gray-500 px-8 py-5">
                        Did not receive an email? <a href="{{ route('password.index') }}" class="font-medium text-emerald-600 hover:underline">Resend Email</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>