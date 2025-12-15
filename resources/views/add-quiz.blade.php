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
                    <div class="text-red-700">{{$message}}
                    </div>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-blue-400  rounded-lg text-center cur">Add</button>
            </form>@else
            <span class="text-green-500 font-bold">Quiz : {{session('quizDetails')->name}}</span>
            <h2 class="text-2xl text-center text-gray-800 mb-4 font-medium">Add MCQs </h2>
            <form class="space-y-4" action="" method="get">

                <div>
                    <textarea type="text" name="quiz" placeholder="Enter your question name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                  </textarea>

                </div>
                <div>
                    <input type="text" name="quiz" placeholder="Enter first option"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">


                </div>
                <div>
                    <input type="text" name="quiz" placeholder="Enter second option"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">


                </div>
                <div>
                    <input type="text" name="quiz" placeholder="Enter third option"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">


                </div>
                <div>
                    <input type="text" name="quiz" placeholder="Enter fourth option"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">


                </div>
                <div>

                    <select name="right answer"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-1">
                        <option value="">Select Right answer</option>
                        <option value="">A</option>
                        <option value="">B</option>
                        <option value="">C</option>
                        <option value="">D</option>
                    </select>

                </div>
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-400  rounded-lg text-center cur">Add
                    More</button>
                <button type="submit" class="w-full px-4 py-2 text-white bg-green-400  rounded-lg text-center cur">Add
                    and Submit</button>
            </form>


            @endif
        </div>

    </div>
    </div>
</body>

</html>