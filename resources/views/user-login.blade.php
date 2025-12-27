<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    @vite('resources/css/app.css')
    <!-- import the css path file path -->
</head>

<body class="min-h-screen">
    <x-user_navbar></x-user_navbar>
    <div class="bg-gray-100 flex justify-center items-center min-h-[calc(100vh-64px)] px-4 py-6 sm:py-8">
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h2 class="text-xl sm:text-2xl text-center text-gray-800 mb-4 sm:mb-6 font-semibold">User Login page</h2>

            @if(session('message-error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded text-sm">
                {{ session('message-error') }}
            </div>
            @endif
            @if(session('message-success'))
            <div>
                <p class="text-green-500 font-bold ">{{session('message-success')}}</p>
            </div>
            @endif

            <form action="{{ url('/user-login') }}" method="post" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm sm:text-base text-gray-600 mb-1">User Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter user email" value="{{old('email')}}"
                        class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">

                </div>
                <div>
                    <label for="password" class="block text-sm sm:text-base text-gray-600 mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter user password"
                        class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">


                    <input type="checkbox" name="remember"> Remember me
                </div>
                <button type="submit"
                    class="w-full px-4 py-2.5 sm:py-3 text-sm sm:text-base text-white bg-blue-400 hover:bg-blue-500 rounded-lg text-center font-medium transition-colors cursor-pointer">Login</button>

                <a href="/user-forgot-password" class="text-green-500">Forgot Password</a>
            </form>
        </div>
    </div>
</body>

</html>
