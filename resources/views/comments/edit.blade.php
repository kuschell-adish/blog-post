@include('/components.header')

<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="px-4 py-10 sm:px-6 lg:px-8 w-full max-w-2xl">
        <div class="bg-white rounded-lg shadow p-6 sm:p-8 lg:p-10">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Comment</h2>
            <p class="mt-1 text-sm text-gray-600">All fields are required.</p>

            <form action="{{ route('comments.update', ['comment' => $comment->id]) }}" method="POST" class="mt-6">
                @method('PUT')
                @csrf
                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-900">Comment</label>
                    <textarea id="comment" name="comment" rows="4"
                        class="mt-2 block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                        required>{{ $comment->comment }}</textarea>
                </div>

                <div class="mt-6 flex flex-col sm:flex-row items-center justify-end gap-4">
                    <a href="{{ route('blogs.index') }}" class="text-sm font-semibold text-gray-900">Cancel</a>
                    <button type="submit"
                        class="w-full sm:w-auto rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
