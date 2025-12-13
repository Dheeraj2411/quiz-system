<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
    <!-- import the css path file path -->
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        <h2 class="text-2xl text-center text-gray-800 mb-6">Admin Login page</h2>
        @error('user')
        <div class="text-red-700">{{$message}}
        </div>
        @enderror
        <form action="" method="post" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="text-gray-600 mb-1">Admin Name</label>
                <input type="text" name="name" id="name" placeholder="Enter admin name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                @error('name')
                <div class="text-red-700">{{$message}}
                </div>
                @enderror
            </div>
            <div>
                <label for="password" class="text-gray-600 mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter admin password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                @error('password')
                <div class="text-red-700">{{$message}}
                </div>
                @enderror
            </div>
            <button type="submit"
                class="w-full px-4 py-2 text-white bg-blue-400  rounded-lg text-center cur">Login</button>
        </form>
    </div>
</body>

</html>