<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        // Fetch admin by name ONLY
        $admin = Admin::where('name', $request->name)->first();

        // Validate password
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return redirect('admin-login')
                ->with('message-error', 'Invalid admin name or password');
        }

        // Login success
        Session::put('admin', $admin);
        return redirect('dashboard');
    }

    function dashboard()
    {
        $admin =  Session::get('admin');
        if ($admin) {
            return view('admin', ["name" => $admin->name]);
        } else {
            return redirect('admin-login');
        }
    }



    function categories()
    {
        $categories = Category::get();
        $admin = Session::get('admin');
        if ($admin) {
            return view('categories', ["name" => $admin->name, 'categories' => $categories]);
        } else {
            return  redirect('admin-login');
        }
    }


    function logout()
    {
        Session::forget('admin');
        return redirect('/admin-login')->with('success', 'Logged out successfully.');
    }



    function addCategory(Request $request)
    {
         $request->validate([
            "category" => "required |min:3|unique:categories,name"
        ]);
        $admin = Session::get('admin');
        $category = new Category();
        $category->name = $request->category;
        $category->creator_id = $admin->id;
        if ($category->save()) {
            Session::flash('category', "Success: Category " . $request->category . " Added.");
        }

        return redirect('admin-categories');
    }


    function deleteCategory($id)
    {
        $isDeleted = Category::find($id)->delete();
        if ($isDeleted) {
            Session::flash('category', "Success: Category  Deleted.");
            return redirect('admin-categories');
        }
    }
    function addQuiz(Request $request)
    {
        $admin = Session::get('admin');

        if (!$admin) {
            return redirect('admin-login');
        }

        $categories = Category::all();
        $totalMCQs = 0;

        // Create quiz only if form submitted
        if ($request->filled(['quiz', 'category_id']) && !Session::has('quizDetails')) {

            $request->validate([
                'quiz' => 'required|min:3',
                'category_id' => 'required|exists:categories,id',
            ]);

            // Prevent duplicate quiz in same category
            $quiz = Quiz::firstOrCreate(
                [
                    'name' => $request->quiz,
                    'category_id' => $request->category_id,
                ]
            );

            Session::put('quizDetails', $quiz);
        }

        // Count MCQs if quiz exists in session
        if (Session::has('quizDetails')) {
            $quiz = Session::get('quizDetails');
            $totalMCQs = Mcq::where('quiz_id', $quiz->id)->count();
        }

        return view('add-quiz', [
            'name' => $admin->name,
            'categories' => $categories,
            'totalMCQs' => $totalMCQs,
        ]);
    }
    function addMCQs(Request $request)
    {

        $request->validate([
            'question' => 'required|min:5',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'correct_ans' => 'required|in:a,b,c,d',
        ]);

        $admin = Session::get('admin');
        $quiz = Session::get('quizDetails');

        if (!$admin || !$quiz) {
            return redirect('admin-login');
        }

        $mcq = new Mcq();
        $mcq->question = $request->question;
        $mcq->a = $request->a;
        $mcq->b = $request->b;
        $mcq->c = $request->c;
        $mcq->d = $request->d;
        $mcq->correct_ans = $request->correct_ans;
        $mcq->admin_id = $admin->id;
        $mcq->quiz_id = $quiz->id;

        if ($mcq->save()) {
            if ($request->submit == "add_more") {
                return redirect(url()->previous());
            } else {
                Session::forget('quizDetails');
                return redirect("/admin-categories");
            }
        }
    }
    function endQuiz()
    {
        Session::forget('quizDetails');
        return redirect("/admin-categories");
    }

    function showQuiz($id, $quizName)
    {
        $admin = Session::get('admin');
        if ($admin) {
            $mcq = Mcq::where('quiz_id', $id)->get();
            return view('show-quiz', ["name" => $admin->name, "mcqs" => $mcq, 'quizName' => $quizName]);
        } else {
            return redirect('admin-login');
        }
    }

    function quizList($id, $category)
    {
        $admin = Session::get('admin');
        if ($admin) {
            $quizData = Quiz::where('category_id', $id)->get();

            return view('quiz-list', ["name" => $admin->name, "quizData" => $quizData, 'category' => $category]);
        } else {
            return redirect('admin-login');
        }
    }
}