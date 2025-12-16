<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Quiz Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>


    <div class="bg-gray-100 flex flex-col  items-center pt-5 min-h-screen">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
            @if (!session('quizDetails'))


            <h2 class="text-2xl text-center text-gray-800 mb-4 font-medium">Add Quiz</h2>

            <form action="add-quiz" method="get" class="space-y-4">

                <div>
                    <input type="text" name="quiz" placeholder="Enter quiz name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                    @error('category')
                    <div class="text-red-700">{{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <select type="text" name="category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                        @foreach ($categories as $category)

                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="green-red-700">{{$message}}
                    </div>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-blue-400  rounded-lg text-center cur">Add</button>
            </form>@else
            <span class="text-green-500 font-bold">Quiz : {{session('quizDetails')->name}}</span>
            <p class="text-green-500 font-bold">Total Quiz : {{$totalMCQs}}
                @if($totalMCQs>0)
                <a class="text-yellow-400 text-sm  hover:text-amber-500  hover:ease-out"
                    href="show-quiz/{{session('quizDetails')->id}}">
                    Show
                    MCQs</a>
                @endif
            </p>

            <h2 class="text-2xl text-center text-gray-800 mb-4 font-medium">Add MCQs </h2>
            <form class="space-y-4" action="add-mcq" method="post">
                @csrf
                <div>
                    <textarea name="question" placeholder="Enter your question name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-1">
</textarea>
                    @error('question')
                    <div class="text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="a" placeholder="Enter first option"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">

                    @error('a')
                    <div class="text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <input type="text" name="b" placeholder="Enter second option"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">

                    @error('b')
                    <div class="text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <input type="text" name="c" placeholder="Enter third option"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                    @error('c')
                    <div class="text-red-500">
                        {{$message}}
                    </div>
                    @enderror

                </div>
                <div>
                    <input type="text" name="d" placeholder="Enter fourth option"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                    @error('d')
                    <div class="text-red-500">
                        {{$message}}
                    </div>
                    @enderror

                </div>
                <div>

                    <select name="correct_ans"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                        <option value="">Select Right answer</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                    @error('correct_ans')
                    <div class="text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit" value="add_more" name="submit"
                    class="w-full px-4 py-2 text-white bg-blue-400  rounded-lg text-center ">Add
                    More</button>
                <button type="submit" value="done" name="submit"
                    class="w-full px-4 py-2 text-white bg-green-400  rounded-lg text-center ">Add
                    and Submit</button>
                <a class="w-full px-4 py-2 text-white bg-red-400 block rounded-lg text-center " href="end-quiz">Finish
                    Quiz</a>
            </form>
            @endif
        </div>

    </div>
    </div>
</body>

</html>