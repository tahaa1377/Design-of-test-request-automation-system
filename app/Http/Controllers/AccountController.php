<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{


    public function page()
    {

       $tests=DB::table('tests')->get();
        return view("page",compact('tests'));
    }

    public function login_page()
    {
        return view("login");
    }


    public function loginCheck(Request $request)
    {


        request()->validate([
            'login_email' => 'required|email',
            'login_password' => 'required|min:5',
        ],[
            'login_email.required' =>'ایمیل نباید خالی باشد',//ارور اختصاصی
            'login_email.email' =>'لطفا یک ایمیل صحیح وارد کنید',//ارور اختصاصی
            'login_password.required' =>'رمز عبور نباید خالی باشد',//ارور اختصاصی
            'login_password.min' =>'رمز عبور نباید کمتر از پنج حرف باشد',//ارور اختصاصی

        ]);


        $email= $request->login_email;
        $password=$request->login_password;


        $bool=DB::select("SELECT * FROM `users` WHERE `email`=?",array($email));

        if ($bool == null){
            $taha['login_error']="ایمیل شما در سیستم وجود ندارد";
            return redirect('/login')->with($taha);
        }else {

            if ($bool[0]->password != md5($password)) {
                $taha['login_error'] = "رمز عبور شما اشتباه است";
                return redirect('/login')->with($taha);
            } else {
                $_SESSION['id'] = $bool[0]->user_id;
                $_SESSION['access'] = $bool[0]->access;
//                $_SESSION['name'] = $bool[0]->name;


                if ($_SESSION['access'] == 'admin') {
                    return redirect()->route('admin.page');
                }else{
                    return redirect()->route('user.page');
                }


            }
        }

    }


    public function register_page()
    {
        return view("register");
    }

    public function registerCheck()
    {

        request()->validate([
            'reg_na' => 'required|min:2',
            'reg_email' => 'required|email',
            'reg_password' => 'required|min:5',
        ],[
            'reg_na.required' =>'نام کاربری نباید خالی باشد',//ارور اختصاصی
            'reg_na.min' =>'نام کاربری نباید کمتر از دو حرف باشد',//ارور اختصاصی
            'reg_email.required' =>'ایمیل نباید خالی باشد',      //ارور اختصاصی
            'reg_email.email' =>'لطفا یک ایمیل صحیح وارد کنید',//ارور اختصاصی
            'reg_password.required' =>'رمز عبور نباید خالی باشد',//ارور اختصاصی
            'reg_password.min' =>'رمز عبور نباید کمتر از پنج حرف باشد',        //ارور اختصاصی

        ]);


        $name= $_POST['reg_na'];
        $email= $_POST['reg_email'];
        $password=$_POST['reg_password'];



        $result=DB::table('users')->where("email",$email)->first();

        if ($result != null){
            $taha['sign_error']="این ایمیل قبلا در سیستم وجود داشته";
            return redirect('/register')->with($taha);
        }else{

            DB::insert("INSERT INTO `users`(`name`, `email`, `password`, `access`) VALUES
                (?,?,?,?)",array($name,$email,md5($password),'user'));


            $user=DB::table("users")->where('email',$email)->first();

            $_SESSION['id']=$user->user_id;
//            $_SESSION['name']=$user->name;

    return redirect('/home');

        }

    }


    public function admin_page()
    {
        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }

        $notif_count=DB::table('notification')->where('seen',0)->count();

        $msgcount=DB::table('messages')->where([
            ['status',0],
            ['messageTo',1],
        ])->count();

        return view('admin_page',compact('notif_count','msgcount'));
    }




    public function logout()
    {

        session_destroy();
        return redirect('/');

    }

}
