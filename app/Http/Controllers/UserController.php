<?php

namespace App\Http\Controllers;

use App\Mail\UserForgotPassword;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use App\Models\Record;
use App\Models\MCQ_Record;
use App\Models\User;
use App\Mail\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Spatie\Browsershot\Browsershot;



class UserController extends Controller
{

    function welcome()
    {
        $categories = Category::withCount('quizzes')->orderBy('quizzes_count', 'desc')->take(5)->get();
        $quizData = Quiz::withCount('records')->orderBy('records_count', 'desc')->take(5)->get();
        return view('welcome', ['categories' => $categories, 'quizData' => $quizData]);
    }

    function userQuizList($id, $category)
    {
        $quizData = Quiz::withCount('mcqs')->where('category_id', $id)->get();
        return view('user-quiz-list', ["quizData" => $quizData, 'category' => $category]);
    }
    function categories()
    {
        $categories = Category::withCount('quizzes')->orderBy('quizzes_count', 'desc')->paginate(3);
        return view('categories-list', ['categories' => $categories]);
    }

    function startQuiz($id)
    {
        $user = User::find(Session::get('user_id'));

        if (!$user || $user->active != 1) {
            return redirect('/user-login')
                ->with('error', 'Your account is not active.');
        }

        Session::forget(['firstMCQ_id', 'currentQuiz']);

        $quiz = Quiz::findOrFail($id);

        $quizCount = Mcq::where('quiz_id', $quiz->id)->count();

        if ($quizCount == 0) {
            return redirect()->back()
                ->with('message-error', 'This quiz has no questions yet.');
        }

        $firstMcq = Mcq::where('quiz_id', $quiz->id)
            ->orderBy('id')
            ->first();

        Session::put('firstMCQ_id', $firstMcq->id);

        return view('start-quiz', [
            'quizName' => $quiz->name,
            'quizCount' => $quizCount,
            'firstMCQ' => $firstMcq,
        ]);
    }


    function userSignUp(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                // Password::min(8)->letters()->numbers()->symbols()->mixedCase(),
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $link = Crypt::encryptString($user->email);
        $link = url('/verify-user/' . $link);
        Mail::to($user->email)->send(new VerifyUser($link));




        if ($user) {
            Session::put([
                'user_id' => $user->id,
                'user_name' => $user->name,
            ]);
            if (Session::has('quiz-url')) {
                $url = Session::pull('quiz-url');
                return redirect($url)->with('message-success', "User registered successfully, Please check email to verify account ");
            }
            return redirect('/')->with('message-success', "user registered successfully, Please check email to verify account");
        }
    }
    function userLogout()
    {
        Session::forget(['user_id', 'user_name']);
        return redirect('/user-login')->with('success', 'Logged out successfully.');
    }
    function userSignupQuiz()
    {
        if (!Session::has('quiz-url')) {
            Session::put('quiz-url', url()->previous());
        }
        return view('user-signup');
    }


    function userlogin(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withInput()->with('message-error', "User not valid, Please check email and password again");
        }

        if ($user) {
            Session::put([
                'user_id' => $user->id,
                'user_name' => $user->name,
            ]);

            if (Session::has('quiz-url')) {
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url);
            } else {
                return redirect('/');
            }
        }
    }

    function userLoginQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-login');
    }

    function mcq($id, $name)
    {
        $mcq = MCQ::findOrFail($id);
        $record = new Record();
        $record->user_id = Session::get('user_id');
        $record->quiz_id = $mcq->quiz_id;
        $record->status = 1;
        if ($record->save()) {
            $currentQuiz = [];
            $currentQuiz['totalMcq'] = MCQ::where('quiz_id', $mcq->quiz_id)->count();
            $currentQuiz['currentMcq'] = 1;
            $currentQuiz['quizName'] = $name;
            $currentQuiz['recordId'] = $record->id;
            $currentQuiz['quizId'] = $mcq->quiz_id;

            Session::put('currentQuiz', $currentQuiz);
            // return $mcq;
            $mcqData = $mcq;
            return view('mcq-page', ['quizName' => $name, 'mcqData' => $mcqData]);
        } else {
            return "something went wrong ";
        }
    }



    function submitAndNext(Request $request, $id)
    {

        $currentQuiz = Session::get('currentQuiz');

        $mcqData = MCQ::where([
            ['id', '>', $id],
            ['quiz_id', '=', $currentQuiz['quizId']]
        ])->first();

        $isExist = MCQ_Record::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['mcq_id', '=', $request->id],
        ])->count();

        if ($isExist < 1) {
            $currentQuiz['currentMcq'] += 1;
            $mcq_record = new MCQ_Record();
            $mcq_record->record_id = $currentQuiz['recordId'];
            $mcq_record->user_id = Session::get('user_id');
            $mcq_record->mcq_id = $request->id;
            $mcq = MCQ::find($request->id);

            $mcq_record->select_answer = $request->option;

            $mcq_record->is_correct = ($request->option === $mcq->correct_ans) ? 1 : 0;

            if (!$mcq_record->save()) {
                return "Something Went Wrong";
            }
        }
        Session::put('currentQuiz', $currentQuiz);
        if ($mcqData) {
            return view('mcq-page', ['quizName' => $currentQuiz['quizName'], 'mcqData' => $mcqData]);
        } else {
            $resultData = MCQ_Record::WithMCQ()->where('record_id', $currentQuiz['recordId'])->get();
            $correctAnswers = MCQ_Record::where([
                [
                    'record_id',
                    '=',
                    $currentQuiz['recordId']
                ],
                ['is_correct', '=', 1],
            ])->count();
            $record = Record::find($currentQuiz['recordId']);
            if ($record) {
                $record->status = 2;
                $record->update();
            }
            return view('quiz-result', ['resultData' => $resultData, 'correctAnswer' => $correctAnswers]);
        }
    }

    function userDetails()
    {
        $quizRecord = Record::WithQuiz()->where('user_id', Session::get('user_id'))->paginate(10);

        return view('user-details', ['quizRecord' => $quizRecord]);
    }
    function searchQuiz(Request $request)
    {
        $quizData = Quiz::withCount('mcqs')->where('name', 'Like', "%{$request->search}%")->get();
        return view('quiz-search', ['quizData' => $quizData, 'quiz' => $request->search]);
    }



    function verifyUser($email)
    {
        $orgEmail = Crypt::decryptString($email);
        $user = User::where('email', $orgEmail)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->active = 1;

            if ($user->save()) {
                return redirect('/')->with('message-success', 'User email verified successfully');
            }
        }
        return redirect('/')->with('error', 'Invalid verification link');
    }
    function userForgotPassword(Request $request)
    {
        $link = Crypt::encryptString($request->email);
        $link = url('/user-forgot-password/' . $link);
        Mail::to($request->email)->send(new UserForgotPassword($link));
        return redirect('/')->with('message-success', "Please check email to set new password ");
    }
    function userResetForgotPassword($email)
    {
        $orgEmail = Crypt::decryptString($email);
        return view('user-set-forgot-password', ['email' => $orgEmail]);
    }
    function userSetForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                // Password::min(8)->letters()->numbers()->symbols()->mixedCase(),
            ],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                return  redirect('/user-login')->with('message-success', 'New Password is set,Please login with new password ');
            };
        }
    }
    function certificate(){
        $data=[];
        $data['quiz']=str_replace('-',' ',Session::get('currentQuiz')['quizName']);
        $data['name']=Session::get('user_name');
        return view('certificate',['data'=>$data]);
    }
    function downloadCertificate(){
        $data = [];
        $data['quiz'] = str_replace('-', ' ', Session::get('currentQuiz')['quizName']);
        $data['name'] = Session::get('user_name');
        $html= view('download-certificate',  ['data' => $data])->render();
        return response(
            Browsershot::html($html)->pdf()
        )->withHeaders([
            'Content-Type'=>"application/pdf",
            'content-disposition'=>"attachment;filename=certificate.pdf",
        ]);
    }
}
