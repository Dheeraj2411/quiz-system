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
        <h2 class="text-2xl text-center text-gray-800 mb-4 font-medium">All Current Quiz's MCQs <a
                class="text-blue-400 text-sm  hover:text-blue-500  hover:ease-out ml-5" href="/add-quiz">Back</a>
        </h2>



        <div class="w-3xl">
            <ul class=" border-gray-300 border-2  rounded-md  ">
                <li class="font-bold  p-2">
                    <ul class=" flex justify-between">
                        <li class="w-30">MCQ Id</li>
                        <li class="w-170">Question</li>
                    </ul>
                </li>

                </li>
                @foreach ($mcqs as $mcq )
                <li class="even:bg-gray-300 p-2 ">
                    <ul class="flex justify-between ">
                        <li class="w-30">{{$mcq->id}}</li>
                        <li class="w-170">{{$mcq->question}}</li>
                    </ul>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
</body>

</html>