<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user_navbar></x-user_navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl text-green-900 p-5 font-bold text-center">Attempted Quiz</h1>


        <div class="w-full max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-4xl xl:max-w-5xl">
            <div class="hidden md:block">
                <ul class="border-gray-300 border-2 rounded-md overflow-hidden">
                    <li class="font-bold p-2 bg-gray-200">
                        <ul class="flex justify-between items-center">
                            <li class="w-20 lg:w-24">S. No</li>
                            <li class="flex-1 px-2">Name</li>
                            <li class="w-20 lg:w-24 text-center">Satus</li>
                        </ul>
                    </li>

                    @foreach ($quizRecord as $key=>$record )
                    <li class="even:bg-gray-300 p-2">
                        <ul class="flex justify-between items-center">
                            <li class="w-20 lg:w-24">{{$key+1}}</li>
                            <li class="flex-1 px-2">{{$record->name}}</li>
                            <li class="w-24 lg:w-32 text-center">
                                @if ($record->status==2)
                                <span class="text-green-500">Completed</span>
                                @else
                                <span class="text-orange-500">Not Completed</span>

                                @endif

                            </li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Mobile view: card layout -->
            <div class="md:hidden space-y-3">
                @foreach ($quizRecord as $key=>$record )
                <div class="border-2 border-gray-300 rounded-lg p-4 bg-white shadow-sm">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <div class="text-xs text-gray-500 mb-1">Category #{{$key+1}}</div>
                            <h3 class="font-semibold text-gray-800 text-base">{{$record->name}}</h3>
                        </div>
                        <a href="user-quiz-list/{{$record->id}}/{{$record->name}}"
                            class="ml-2 p-2 hover:bg-gray-100 rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#000000">
                                <path
                                    d="M480-312q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Zm0-72q-40 0-68-28t-28-68q0-40 28-68t68-28q40 0 68 28t28 68q0 40-28 68t-68 28Zm0 192q-142.6 0-259.8-78.5Q103-349 48-480q55-131 172.2-209.5Q337.4-768 480-768q142.6 0 259.8 78.5Q857-611 912-480q-55 131-172.2 209.5Q622.6-192 480-192Zm0-288Zm0 216q112 0 207-58t146-158q-51-100-146-158t-207-58q-112 0-207 58T127-480q51 100 146 158t207 58Z" />
                            </svg>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600">Quizzes:</span>
                        <span class="ml-2 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{$record->quizzes_count}}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-user_footer>
    </x-user_footer>
</body>

</html>
