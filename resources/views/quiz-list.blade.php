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

    <div class="bg-gray-100 flex flex-col  items-center pt-5 min-h-screen">
        <h2 class="text-2xl text-center text-gray-800 mb-4 font-medium">Category Name : {{$category}} </h2>

        <div class="w-3xl">
            <ul class=" border-gray-300 border-2  rounded-md  ">
                <li class="font-bold  p-2">
                    <ul class=" flex justify-between">
                        <li class="w-30">Quiz Id</li>
                        <li class="w-140">Name</li>
                        <li class="w-30">Action</li>
                    </ul>
                </li>

                </li>
                @foreach ($quizData as $item )
                <li class="even:bg-gray-300 p-2 ">
                    <ul class="flex justify-between ">
                        <li class="w-30">{{$item->id}}</li>
                        <li class="w-140">{{$item->name}}</li>
                        <li class="w-30"> <a href="/show-quiz/{{$item->id}}/{{Str::slug($item->name)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                    width="20px" fill="#000000">
                                    <path
                                        d="M480-312q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Zm0-72q-40 0-68-28t-28-68q0-40 28-68t68-28q40 0 68 28t28 68q0 40-28 68t-68 28Zm0 192q-142.6 0-259.8-78.5Q103-349 48-480q55-131 172.2-209.5Q337.4-768 480-768q142.6 0 259.8 78.5Q857-611 912-480q-55 131-172.2 209.5Q622.6-192 480-192Zm0-288Zm0 216q112 0 207-58t146-158q-51-100-146-158t-207-58q-112 0-207 58T127-480q51 100 146 158t207 58Z" />
                                </svg></a></li>

                    </ul>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
</body>

</html>