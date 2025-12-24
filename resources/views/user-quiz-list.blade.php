<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user_navbar></x-user_navbar>
    <!-- Made container responsive with proper padding and max-width -->
    <div class="bg-gray-100 flex flex-col items-center px-4 sm:px-6 lg:px-8 pt-5 min-h-screen">
        <h2 class="text-xl sm:text-2xl text-center text-green-900 mb-4 font-bold">Category Name : {{$category}}</h2>

        <!-- Added responsive width constraints and overflow handling -->
        <div class="w-full max-w-4xl">
            <!-- Made table scrollable on mobile -->
            <div class="overflow-x-auto">
                <ul class="border-gray-300 border-2 rounded-md min-w-full">
                    <li class="font-bold p-2 bg-gray-50">
                        <ul class="flex justify-between gap-2 sm:gap-4">
                            <li class="w-16 sm:w-24 shrink-0">Quiz Id</li>
                            <li class="flex-1 min-w-0">Name</li>
                            <li class="w-16 sm:w-24 shrink-0">Mcq Count</li>
                            <li class="w-24 sm:w-32 shrink-0 text-right sm:text-left">Action</li>
                        </ul>
                    </li>

                    @foreach ($quizData as $item )
                    <li class="even:bg-gray-300 p-2">
                        <ul class="flex justify-between gap-2 sm:gap-4 items-center">
                            <li class="w-16 sm:w-24 shrink-0 text-sm sm:text-base">{{$item->id}}</li>
                            <li class="flex-1 min-w-0 text-sm sm:text-base wrap-break-word">{{$item->name}}
                            </li>
                            <li class="w-16 sm:w-24 shrink-0 text-sm sm:text-base">{{$item->mcqs_count}}
                            </li>
                            <li class="w-24 sm:w-32 shrink-0 text-right sm:text-left">
                                <a href="/start-quiz/{{$item->id}}/{{Str::slug($item->name)}}"
                                    class="text-green-500 hover:text-green-700 font-bold text-xs sm:text-sm inline-block">
                                    Attempt Quiz
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>

</html>