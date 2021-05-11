<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function notification_count()
    {

        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }


        $notif_count=DB::table('notification')->where('seen',0)->count();


        echo json_encode(array(
            'notifcount' => $notif_count,
        ));

    }


    public function message_count()
    {
        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }



        $msg_count=DB::table('messages')->where([
            ['status',0],
            ['messageTo',1],
        ])->count();


        echo json_encode(array(
            'msgfcount' => $msg_count,
        ));
    }


    public function msgseen()
    {
        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }

        $notif=DB::select("SELECT COUNT(messages.messageId) AS co , users.* , forms.* FROM
  users LEFT OUTER JOIN forms ON users.user_id=forms.user_id LEFT OUTER JOIN messages ON
  messages.form_id=forms.form_id
  WHERE( messages.messageTo = ? AND messages.status = 0  and forms.finish = 0 )
  GROUP BY forms.form_id ORDER BY COUNT(`messages`.messageId) DESC",array(1));


        $valu=array();
        foreach ($notif as $item){
            $valu[] = $item->form_id;
        }


        $notif1=DB::table('users')
            ->leftJoin('forms','users.user_id','=','forms.user_id')
            ->leftJoin('messages','messages.form_id','=','forms.form_id')
            ->whereNotIn('forms.form_id',$valu)->select('users.*' , 'forms.*')
            ->groupBy('forms.form_id')
            ->get();



        return view('msg-page',compact('notif','notif1'));


    }


    public function notifseen()
    {


        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }

        $notif=DB::table('notification')
            ->leftJoin('users','users.user_id','=','notification.user_id')
            ->leftJoin('forms','forms.form_id','=','notification.form_id')
//            ->leftJoin('messages','forms.form_id','=','messages.form_id')
            ->where('notification.seen',0)
            ->get();


        DB::table('notification')->where('seen',0)->update([
            'seen' => 1
        ]);

        return view('notification-page',compact('notif'));

    }


    public function testDoing()
    {

        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }

        $notif=DB::select("SELECT COUNT(messages.messageId) AS co , users.* , forms.* FROM
           users LEFT OUTER JOIN forms ON users.user_id=forms.user_id LEFT OUTER JOIN messages ON
           messages.form_id=forms.form_id
           WHERE( messages.messageTo = ? AND messages.status = 0  and forms.finish = 0 )
           GROUP BY forms.form_id ORDER BY COUNT(`messages`.messageId) DESC",array(1));


        $valu=array();
        foreach ($notif as $item){
            $valu[] = $item->form_id;
        }


            $notif1=DB::table('users')
            ->leftJoin('forms','users.user_id','=','forms.user_id')
            ->leftJoin('messages','messages.form_id','=','forms.form_id')
            ->where('forms.finish','=',0)
            ->whereNotIn('forms.form_id',$valu)->select('users.*' , 'forms.*')
            ->groupBy('forms.form_id')
            ->get();


        return view('testDoing',compact('notif','notif1'));

    }


    public function messenger($form_id,$user_id)
    {

        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }

        $_SESSION['form_id']=$form_id;

        DB::table('messages')
            ->where([
            ['form_id',$form_id],
            ['messageTo',$_SESSION['id']]
        ])->update([
           'status'=> 1
        ]);


        $user=DB::table('users')->where('user_id',$user_id)->first();


//        $messages=DB::table('messages')->where([
//            ['form_id',$form_id],
//        ])->get();

       // print_r($messages);

        return view('messager',compact('user_id','user'));

    }


    public function messenger_result()
    {

        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }


        DB::table('messages')
            ->where([
                ['form_id',$_SESSION['form_id']],
                ['messageTo',$_SESSION['id']]
            ])->update([
                'status'=> 1
            ]);

        $messages=DB::table('messages')->where([
            ['form_id',$_SESSION['form_id']],
        ])->groupBy('messageOn')
            ->get();

        return view('messager-res',compact('messages'));

    }


    public function sendMsg(Request $request)
    {

        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }

//        request()->validate([
//            'text' => 'required',
//        ]);


        $message=$_POST['text'];
        $messageFrom=$_SESSION['id'];
        $messageTo=$_POST['msgTo'];
        $form_id= $_SESSION['form_id'];



        if ($_FILES['file']['name'] != null){
            $media = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('img'), $media);
        }else{
            $media=null;
        }

        if ($media == null && $message==null){
            return;
        }


        DB::insert('INSERT INTO `messages`(`form_id`, `messageFrom`, `messageTo`, `message`, `messageMedia`)
 VALUES (?,?,?,?,?)',array($form_id,$messageFrom,$messageTo,$message,$media));


    }

    public function testDefine()
    {
        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }
        return view('testDefine');

    }

    public function test_define_form()
    {

        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }


        request()->validate([
            'name_test' => 'required',
            'test_price_student' => 'required',
            'test_price_company' => 'required',
        ],[
            'name_test.required' =>'نام تست نباید خالی باشد',//ارور اختصاصی
            'test_price_student.required' =>'قیمت تست نباید خالی باشد',//ارور اختصاصی
            'test_price_company.required' =>'قیمت تست نباید خالی باشد',      //ارور اختصاصی
        ]);

        DB::insert('INSERT INTO `tests`(`name`, `student_price`, `company_price`) VALUES (?,?,?)',
            array($_POST['name_test'],$_POST['test_price_student'],$_POST['test_price_company']));

        return redirect('/admin_pages');

    }


    public function amar()
    {
        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }



        $notif_count=DB::table('notification')->where('seen',0)->count();

        $msgcount=DB::table('messages')->where([
            ['status',0],
            ['messageTo',1],
        ])->count();

        $notif1=DB::table('users')
            ->leftJoin('forms','users.user_id','=','forms.user_id')
            ->leftJoin('messages','messages.form_id','=','forms.form_id')
            ->where('forms.finish','=',1)
            ->select('users.*' , 'forms.*')
            ->groupBy('forms.form_id')
            ->get();

        return view('amar',compact('notif_count','msgcount','notif1'));
    }


    public function finish_form_id($form_id)
    {

        if ($_SESSION['access'] != 'admin'){
            return redirect('/login');
        }

        DB::table('forms')->where('form_id',$form_id)->update([
            'finish' => 1
        ]);

        DB::table('messages')->where('form_id',$form_id)->update([
            'status' => 1
        ]);

        $taha['end_form']="تست مربوطه اتمام یافت ";
        return redirect('/admin_pages')->with($taha);

    }


    public function documents_form_id($form_id)
    {

        $documents=DB::table('messages')->where([
           ['form_id',$form_id],
        ])->whereNotNull('messageMedia')->get();


        return view('documents',compact('documents'));

    }


}



