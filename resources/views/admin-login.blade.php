<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
    <!-- import the css path file path -->
</head>

<body class="min-h-screen">
    <x-navbar :name="$name ?? 'Guest'" />
    <!-- Added responsive padding and proper height calculation -->
    <div class="bg-gray-100 flex justify-center items-center min-h-[calc(100vh-64px)] px-4 py-6 sm:py-8">
        <!-- Added responsive padding and width constraints -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <!-- Made heading responsive with smaller text on mobile -->
            <h2 class="text-xl sm:text-2xl text-center text-gray-800 mb-4 sm:mb-6 font-semibold">Admin Login page</h2>
            @if(session('message-error'))
            <div class="text-red-600">
                {{ session('message-error') }}
            </div>
            @endif
            <form action="admin-login" method="post" class="space-y-4">
                @csrf
                <div>
                    <!-- Made labels responsive and added block display -->
                    <label for="name" class="block text-sm sm:text-base text-gray-600 mb-1">Admin Name</label>
                    <!-- Improved input styling with better focus states -->
                    <input type="text" name="name" id="name" placeholder="Enter admin name" value="{{ old('name') }}"
                        class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    @error('name')
                    <div class="text-red-700 text-xs sm:text-sm mt-1">{{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm sm:text-base text-gray-600 mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter admin password"
                        class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    @error('password')
                    <div class="text-red-700 text-xs sm:text-sm mt-1">{{$message}}
                    </div>
                    @enderror
                </div>
                <!-- Improved button styling with better mobile touch target and hover states -->
                <button type="submit"
                    class="w-full px-4 py-2.5 sm:py-3 text-sm sm:text-base text-white bg-blue-400 hover:bg-blue-500 rounded-lg text-center font-medium transition-colors cursor-pointer">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
