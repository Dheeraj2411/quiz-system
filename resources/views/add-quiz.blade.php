<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Quiz Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>

    <!-- Added responsive padding and adjusted container width for mobile -->
    <div class="bg-gray-100 flex flex-col items-center pt-3 px-4 sm:pt-5 sm:px-6 min-h-screen">
        <div class="bg-white p-4 sm:p-6 md:p-8 rounded-2xl shadow-lg w-full max-w-md md:max-w-lg">
            @if (!session('quizDetails'))

            <!-- Made heading responsive with smaller text on mobile -->
            <h2 class="text-xl sm:text-2xl text-center text-gray-800 mb-3 sm:mb-4 font-medium">Add Quiz</h2>

            <form action="add-quiz" method="get" class="space-y-3 sm:space-y-4">

                <div>
                    <input type="text" name="quiz" placeholder="Enter quiz name"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-1">
                    @error('category')
                    <div class="text-red-700 text-sm mt-1">{{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <select type="text" name="category_id"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-1">
                        @foreach ($categories as $category)

                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="text-red-700 text-sm mt-1">{{$message}}
                    </div>
                    @enderror
                </div>

                <!-- Made button responsive with adjusted padding and text -->
                <button type="submit"
                    class="w-full px-4 py-2.5 sm:py-3 text-sm sm:text-base text-white bg-blue-400 hover:bg-blue-500 rounded-lg text-center transition-colors">Add</button>
            </form>

            @else
            <!-- Made quiz info section responsive -->
            <div class="space-y-2 mb-4">
                <span class="text-green-500 font-bold text-sm sm:text-base block">Quiz:
                    {{session('quizDetails')->name}}</span>
                <p class="text-green-500 font-bold text-sm sm:text-base">Total Quiz: {{$totalMCQs}}
                    @if($totalMCQs>0)
                    <a class="text-yellow-400 text-xs sm:text-sm hover:text-amber-500 hover:ease-out ml-2"
                        href="show-quiz/{{session('quizDetails')->id}}/{{session('quizDetails')->name}}">
                        Show MCQs
                    </a>
                    @endif
                </p>
            </div>

            <h2 class="text-xl sm:text-2xl text-center text-gray-800 mb-3 sm:mb-4 font-medium">Add MCQs</h2>

            <form class="space-y-3 sm:space-y-4" action="add-mcq" method="post">
                @csrf
                <div>
                    <textarea name="question" placeholder="Enter your question" rows="3"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-1 resize-none"></textarea>
                    @error('question')
                    <div class="text-red-500 text-sm mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="a" placeholder="Enter first option"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-1">
                    @error('a')
                    <div class="text-red-500 text-sm mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="b" placeholder="Enter second option"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-1">
                    @error('b')
                    <div class="text-red-500 text-sm mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="c" placeholder="Enter third option"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-1">
                    @error('c')
                    <div class="text-red-500 text-sm mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="d" placeholder="Enter fourth option"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-1">
                    @error('d')
                    <div class="text-red-500 text-sm mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <select name="correct_ans"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-1">
                        <option value="">Select Right answer</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                    @error('correct_ans')
                    <div class="text-red-500 text-sm mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <!-- Made buttons responsive with adjusted padding and hover states -->
                <button type="submit" value="add_more" name="submit"
                    class="w-full px-4 py-2.5 sm:py-3 text-sm sm:text-base text-white bg-blue-400 hover:bg-blue-500 rounded-lg text-center transition-colors">Add
                    More</button>

                <button type="submit" value="done" name="submit"
                    class="w-full px-4 py-2.5 sm:py-3 text-sm sm:text-base text-white bg-green-400 hover:bg-green-500 rounded-lg text-center transition-colors">Add
                    and Submit</button>

                <a class="w-full px-4 py-2.5 sm:py-3 text-sm sm:text-base text-white bg-red-400 hover:bg-red-500 block rounded-lg text-center transition-colors"
                    href="end-quiz">Finish Quiz</a>
            </form>
            @endif
        </div>
    </div>
</body>

</html>