<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen px-4 sm:px-6 lg:px-8 ">
        @if(session('message-success'))
        <div>
            <p class="text-green-500 font-bold ">{{session('message-success')}}</p>
        </div>
        @endif
        <h1 class="text-2xl sm:text-3xl lg:text-4xl text-green-900 p-5 font-bold text-center">Users List</h1>
        <div class="max-w-md w-full mb-6">
            <div class="relative">
                <form action="/search-quiz" method="get">
                    <input type="text" name="search" placeholder="Search users... "
                        class="w-full text-gray-700 focus:outline-1 rounded-2xl py-3 px-4 border border-gray-400 shadow">
                    <button
                        class="absolute right-0.5 hover:bg-gray-300  px-4 py-3 top-0.5 cursor-pointer bg-gray-200 rounded-xl"><svg
                            xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#000000">
                            <path
                                d="M765-144 526-383q-30 22-65.79 34.5-35.79 12.5-76.18 12.5Q284-336 214-406t-70-170q0-100 70-170t170-70q100 0 170 70t70 170.03q0 40.39-12.5 76.18Q599-464 577-434l239 239-51 51ZM384-408q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Z" />
                        </svg></button>
                </form>
            </div>
        </div>

        <div class="w-full max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-4xl xl:max-w-5xl">
            <h1 class="text-xl sm:text-2xl text-green-900 text-center font-bold my-5">All Users </h1>

            <!-- Desktop view: table layout -->
            <div class="hidden md:block">
                <ul class="border-gray-300 border-2 rounded-md overflow-hidden">
                    <li class="font-bold p-2 bg-gray-200">
                        <ul class="flex justify-between items-center">
                            <li class="w-20 lg:w-24">S No.</li>
                            <li class="w-20 lg:w-24">User Id</li>
                            <li class="flex-1 px-2">User Name</li>
                            <li class="w-24 lg:w-32 text-center">User Email</li>

                        </ul>
                    </li>

                    @foreach ($users as $key=>$user )
                    <li class="even:bg-gray-300 p-2">
                        <ul class="flex justify-between items-center">
                            <li class="w-20 lg:w-24">{{$key+1}}</li>
                            <li class="w-20 lg:w-24">{{$user->id}}</li>
                            <li class="flex-1 px-2">{{$user->name}}</li>
                            <li class="w-24 lg:w-32 text-center">{{$user->email}}</li>
                            <li class="w-20 lg:w-24 flex justify-center">
                                <!-- <a href="" class="hover:opacity-70 transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                        width="20px" fill="#000000">
                                        <path
                                            d="M480-312q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Zm0-72q-40 0-68-28t-28-68q0-40 28-68t68-28q40 0 68 28t28 68q0 40-28 68t-68 28Zm0 192q-142.6 0-259.8-78.5Q103-349 48-480q55-131 172.2-209.5Q337.4-768 480-768q142.6 0 259.8 78.5Q857-611 912-480q-55 131-172.2 209.5Q622.6-192 480-192Zm0-288Zm0 216q112 0 207-58t146-158q-51-100-146-158t-207-58q-112 0-207 58T127-480q51 100 146 158t207 58Z" />
                                    </svg>
                                </a> -->
                            </li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>



            <div class="mt-4">
                {{$users->links()}}
            </div>
        </div>



    </div>
</body>

</html>
