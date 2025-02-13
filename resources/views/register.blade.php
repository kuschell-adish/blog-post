<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 p-10">
    <div class="bg-white rounded-lg p-10 shadow">
        <p class="text-xl text-emerald-600 font-bold pb-7">Let's get started with your account!</p>
    <form action="/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600 mb-10">These credentials will be used to login.</p>
            
            <div class="col-span-full ">
                <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Profile Photo</label>
                <div class="mt-2 flex items-center gap-x-3">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  </svg>

                  <input id ="photo" type ="file" name="photo" class="rounded-md bg-white px-2.5 py-1.5 text-sm text-gray-900">
                </div>
                @error('photo')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                    @enderror
              </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-4">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email <span class="text-sm text-red-500">*</span></label>
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
                <div class="sm:col-span-4">
                  <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password <span class="text-sm text-red-500">*</span></label>
                  <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300  sm:max-w-md">
                      <input type="password" name="password" id="password" class="p-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" required>
                    </div>
                    <p class="text-xs text-gray-600">Password must have at least 8 characters and must contain the following: uppercase letters, lowercase letters, numbers, and symbols.</p>
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
                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First name <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input type="text" name="first_name" id="first_name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{old('first_name')}}" >
                </div>
                @error('first_name')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
              </div>
      
              <div class="sm:col-span-3">
                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last name <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input type="text" name="last_name" id="last_name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{old('last_name')}}">
                </div>
                @error('last_name')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
              </div>
      
              <div class="sm:col-span-3">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input id="username" name="username" type="text" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required value="{{old('username')}}">
                </div>
                @error('username')
                    <p class="text-xs text-red-700 mt-2">{{$message}}</p>
                @enderror
              </div>

              <div class="sm:col-span-3">
                <label for="birthday" class="block text-sm font-medium leading-6 text-gray-900">Birthday <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                  <input id="birthday" type="date" name="birthday" class="p-2 block w-full rounded-md border-0 py-[5px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" max="2005-12-31" required value="{{old('birthday')}}">
                </div>
              </div>

              <div class="sm:col-span-3">
                <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">Gender <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                    <select id="gender" name="gender" class="p-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        <option value="" {{ old('gender') == "" ? 'selected' : '' }}>Choose Gender</option>
                        <option value="Male" {{ old('gender') == "Male" ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == "Female" ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>
  
              <div class="sm:col-span-3">
                <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Province <span class="text-sm text-red-500">*</span></label>
                <div class="mt-2">
                <select name="province" id="province" class="p-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" required>
                    <option value="" disabled selected>Select a Province</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province['code'] }}">{{ $province['name'] }}</option>
                    @endforeach
                </select>
                </div>
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
      document.getElementById("username").value = ""; 
      document.getElementById("birthday").value = ""; 
      document.getElementById("gender").value = ""; 
      document.getElementById("address").value = ""; 
      document.getElementById("photo").value = ""; 
    });
</script>