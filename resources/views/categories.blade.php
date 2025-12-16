<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>
    @if (session('category'))
    <div class=" bg-green-800 text-white pl-5">
        {{ session('category') }}
    </div>
    @endif

    <div class="bg-gray-100 flex flex-col  items-center pt-5 min-h-screen">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h2 class="text-2xl text-center text-gray-800 mb-4 font-medium">Add Category</h2>

            <form action="add-category" method="post" class="space-y-4">
                @csrf
                <div>
                    <input type="text" name="category" placeholder="Enter category name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                    @error('category')
                    <div class="text-red-700">{{$message}}
                    </div>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-blue-400  rounded-lg text-center cur">Add</button>
            </form>
        </div>
        <div class="w-3xl">
            <h1 class="text-2xl text-blue-500 font-medium">Category List</h1>
            <ul class=" border-gray-300 border-2  rounded-md  ">
                <li class="font-bold  p-2">
                    <ul class=" flex justify-between">
                        <li class="w-30">S. No</li>
                        <li class="w-70">Name</li>
                        <li class="w-70">Creator</li>
                        <li class="w-30">Action</li>
                    </ul>
                </li>


                </li>
                @foreach ($categories as $category )
                <li class="even:bg-gray-300 p-2 ">
                    <ul class="flex justify-between ">
                        <li class="w-30">{{$category->id}}</li>
                        <li class="w-70">{{$category->name}}</li>
                        <li class="w-70">{{$category->creator}}</li>
                        <li class="w-30">
                            <a href="category/delete/{{$category->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                    width="20px" fill="#000000">
                                    <path
                                        d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z" />
                                </svg></a>
                        </li>
                    </ul>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
</body>

</html>