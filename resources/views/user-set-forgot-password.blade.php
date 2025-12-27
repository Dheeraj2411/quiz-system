<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Password</title>
    @vite('resources/css/app.css')
    <!-- import the css path file path -->
</head>

<body class="min-h-screen">
    <x-user_navbar></x-user_navbar>
    <div class="bg-gray-100 flex justify-center items-center min-h-[calc(100vh-64px)] px-4 py-6 sm:py-8">
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h2 class="text-xl sm:text-2xl text-center text-gray-800 mb-4 sm:mb-6 font-semibold">User Set Password</h2>
            @error('user')
            <div class="text-red-700 text-sm mb-4">{{$message}}
            </div>
            @enderror
            <form action="/user-set-forgot-password" method="post" class="space-y-4">
                @csrf
                <div>
                    <input type="hidden" name="email" id="email" placeholder="Enter User email" value="{{$email}}"
                        class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    @error('email')
                    <div class="text-red-700 text-xs sm:text-sm mt-1">{{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm sm:text-base text-gray-600 mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter User password"
                        class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    @error('password')
                    <div class="text-red-700 text-xs sm:text-sm mt-1">{{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm sm:text-base text-gray-600 mb-1">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder=" Confirm User password"
                        class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    @error('password_confirmation')
                    <div class="text-red-700 text-xs sm:text-sm mt-1">{{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full px-4 py-2.5 sm:py-3 text-sm sm:text-base text-white bg-blue-400 hover:bg-blue-500 rounded-lg text-center font-medium transition-colors cursor-pointer">Update
                    Password</button>
            </form>
        </div>
    </div>
</body>

</html>