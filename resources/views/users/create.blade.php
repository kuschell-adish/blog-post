@include('/components.header')
<body class="bg-gray-50 p-10">
    <div class="bg-white rounded-lg p-10 shadow">
        <p class="text-xl text-emerald-600 font-bold pb-7">Let's get started with your account!</p>
    <form action="{{ route('users.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600 mb-10">These credentials will be used to login.</p>
            
            <div class="col-span-full">
                <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Profile Photo</label>
                <div class="mt-2 flex items-center gap-x-3">               
                  <div class="max-w-sm">
                      <label class="block">
                        <span class="sr-only">Choose profile photo</span>
                        <input id="photo" name="photo" type="file" accept="image/png, image/jpeg, image/jpg" class="block w-full text-sm text-gray-500
                          file:me-4 file:py-2 file:px-4
                          file:rounded-lg file:border-0
                          file:text-sm file:font-semibold
                          file:bg-emerald-600 file:text-white
                          hover:file:bg-emerald-700
                          file:disabled:opacity-50 file:disabled:pointer-events-none
                        ">
                      </label>
                  </div>
                </div>
                @error('photo')
                  <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-2">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                  <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-md">
                    <input type="email" name="email" id="email" class="p-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" required value="{{old('email')}}">
                  </div>
                  @error('email')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                  @enderror
                </div>
              </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-2">
                  <div class="flex flex-row justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <p id="togglePassword" class="block text-sm font-medium leading-6 text-emerald-600 cursor-pointer">Show Password</p>
                </div>
                  <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300  sm:max-w-md">
                      <input type="password" name="password" id="password" class="p-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" required>
                    </div>
                    <p class="text-xs text-gray-500 italic mt-1">Password must have at least 8 characters and must contain the following: uppercase letters, lowercase letters, numbers, and symbols.</p>
                    @error('password')
                      <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                    @enderror
                  </div>
                </div>
            </div>  
          </div>
  
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">To add the basic information to your profile.</p>
      
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                <div class="mt-2">
                  <input type="text" name="first_name" id="first_name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{old('first_name')}}" >
                </div>
                @error('first_name')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
              </div>
      
              <div class="sm:col-span-3">
                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                <div class="mt-2">
                  <input type="text" name="last_name" id="last_name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{old('last_name')}}">
                </div>
                @error('last_name')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
              </div>
            </div>
          </div>

        </div>
      
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button type="button" id="cancelButton" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
          <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Sign up</button>
        </div>
        
    </form>   
  </div>
</body>
</html>

<script>
    var cancelButton = document.getElementById("cancelButton");

    cancelButton.addEventListener("click", function(){
      document.getElementById("email").value = ""; 
      document.getElementById("password").value = ""; 
      document.getElementById("first_name").value = ""; 
      document.getElementById("last_name").value = ""; 
      document.getElementById("photo").value = ""; 
    });

    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';
        this.textContent = isPassword ? 'Hide Password' : 'Show Password'
    }); 
</script>