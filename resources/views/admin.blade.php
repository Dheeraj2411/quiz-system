<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="bg-white  shadow-md px-4 py-2">
        <div class="flex justify-between items-center">
            <div class="text-2xl text-gray-700 hover:bg-gray-100 cursor-pointer rounded-xl p-1 font-bold">
                Quiz System
            </div>
            <div class="space-x-3">
                <a class="text-gray-700 hover:bg-gray-100 rounded-xl  p-1" href="http#">Categories</a>
                <a class="text-gray-700 hover:bg-gray-100 rounded-xl  p-1" href="http#">Quiz</a>
                <a class="text-gray-700 hover:bg-gray-100 rounded-xl  p-1" href="http#">Welcome {{$name}}</a>
                <a class="text-gray-700 hover:bg-gray-100 rounded-xl  p-1" href="http#">Login</a>
            </div>
        </div>

    </nav>
</body>

</html>
