<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>quiz page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user_navbar></x-user_navbar>
    @if(session('message-success'))
    <div>
        <p class=" text-green-500 font-bold">{{session('message-success')}}</p>
    </div>
    @endif
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-2">
        <h1 class="text-4xl text-center text-green-800  space font-bold ">
            {{$quizName}}
        </h1>
        <h2 class="text-3xl text-center text-green-800 mb-1 font-bold ">
            Question No. {{session('currentQuiz')['currentMcq']}}
        </h2>
        <h2 class="text-3xl text-center text-green-800 mb-2 font-bold ">
            {{session('currentQuiz')['currentMcq']}} of
            {{session('currentQuiz')['totalMcq']}}
        </h2>
        <div class="mt-2 p-4 bg-white shadow-2xl rounded-xl w-140 ">
            <h3 class="text-green-900 font-bold text-xl mb-4 pl-2">{{$mcqData->question}}</h3>
            <form action="/mcq/{{$mcqData->id}}" method="post" class="space-y-4">
                @csrf
                <input type="hidden" name="id" value="{{$mcqData->id}}">
                <label for="option_1"
                    class="flex border border-gray-400 p-3 rounded-2xl shadow-xl cursor-pointer font-medium hover:bg-gray-200 ">
                    <input class="" type="radio" name="option" id="option_1" value="a">
                    <span class="text-green-900 pl-2">{{$mcqData->a}}</span>
                </label>
                <label for="option_2"
                    class="flex  border border-gray-400 p-3 rounded-2xl font-medium shadow-xl cursor-pointer hover:bg-gray-200 ">
                    <input class="" type="radio" name="option" id="option_2" value="b">
                    <span class="text-green-900 pl-2">{{$mcqData->b}}</span>
                </label>
                <label for="option_3"
                    class="flex  border border-gray-400 p-3 rounded-2xl shadow-xl cursor-pointer font-medium hover:bg-gray-200 ">
                    <input class="" type="radio" name="option" id="option_3" value="c">
                    <span class="text-green-900 pl-2">{{$mcqData->c}}</span>
                </label>
                <label for="option_4"
                    class="flex  border border-gray-400 p-3 rounded-2xl shadow-xl cursor-pointer font-medium hover:bg-gray-200">
                    <input class="" type="radio" name="option" id="option_4" value="d">
                    <span class="text-green-900 pl-2">{{$mcqData-> d }}</span>
                </label>
                <button type="submit"
                    class="w-full px-4 py-2.5 sm:py-3 text-sm sm:text-base text-white bg-blue-700 hover:bg-blue-600 rounded-lg text-center font-medium transition-colors cursor-pointer">Submit
                    Answer and Next
                </button>
            </form>
        </div>





    </div>
</body>
<x-user_footer>
</x-user_footer>

</html>