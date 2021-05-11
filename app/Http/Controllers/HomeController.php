<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{



    public function home()
    {

        if (!isset($_SESSION['id']) || empty($_SESSION['id'])){
            return redirect('/login');
        }

        $msgcount=DB::table('messages')->where([
            ['status',0],
            ['messageTo',$_SESSION['id']],
        ])->count();

        return view('home',compact('msgcount'));

    }

    public function newProjectStudent()
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])){
            return redirect('/login');
        }

        $tests=DB::table('tests')->get();
        return view('new-project-stu',compact('tests'));
    }

    public function newProjectCompany()
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])){
            return redirect('/login');
        }

        $tests=DB::table('tests')->get();
        return view('new-project-com',compact('tests'));
    }



    public function project_list()
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])){
            return redirect('/login');
        }


        $type=$_POST['type'];

        if ($type == 'stu'){

            $tests=DB::table('tests')->get();
            return view('student',compact('tests'));

        }else{
            $tests=DB::table('tests')->get();
            return view('company',compact('tests'));
        }

    }

    public function set_price()
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])){
            return redirect('/login');
        }



        $_SESSION['setprice']=$_POST['price_s'];

       // return $_SESSION['setprice'];
    }


    public function payment_stu()
    {

        if (!isset($_SESSION['id']) || empty($_SESSION['id'])){
            return redirect('/login');
        }

        request()->validate([
            'name_family' => 'required',
            'uni' => 'required|max:255',
            'description' => 'required'
        ],[
            'name_family.required' =>'نام و نام خانوادگی نباید خالی باشد',//ارور اختصاصی
            'uni.required' =>'نام دانشگاه نباید خالی باشد',//ارور اختصاصی
            'uni.max' =>'نام دانشگاه طولانی است',//ارور اختصاصی
            'description.required' =>'توضیحات نباید خالی باشد',      //ارور اختصاصی

        ]);


        $form=Form::create([
            'user_id' => $_SESSION['id'],
            'type' => 'student',
            'place'   => $_POST['uni'],
            'description'    => $_POST['description'],
            'total_price' => $_SESSION['setprice'],
        ]);



        for ($i=0; $i<count($_POST); $i++){

            if ($this->contains(array_keys($_POST)[$i],'count_')  and array_values($_POST)[$i] > 0){
                //echo array_keys($_POST)[$i]."  ". array_values($_POST)[$i];
                $pieces = explode("_",array_keys($_POST)[$i]);
//                echo $pieces[1];
//                echo array_values($_POST)[$i];
                    DB::insert("INSERT INTO `list_tests`(`form_id`, `test_id`, `quantity`) VALUES (?,?,?)"
                                ,array($form->form_id,$pieces[1],array_values($_POST)[$i]));
            }
        }


        DB::insert("INSERT INTO `notification`(`user_id`, `form_id`) VALUES (?,?)",array($_SESSION['id'],$form->form_id));




        return redirect('/home');

    }

    public function payment_com()
    {

        if (!isset($_SESSION['id']) || empty($_SESSION['id'])){
            return redirect('/login');
        }

        request()->validate([
            'name_family' => 'required',
            'uni' => 'required|max:255',
            'description' => 'required'
        ],[
            'name_family.required' =>'نام و نام خانوادگی نباید خالی باشد',//ارور اختصاصی
            'uni.required' =>'نام شرکت نباید خالی باشد',//ارور اختصاصی
            'uni.max' =>'نام دانشگاه طولانی است',//ارور اختصاصی
            'description.required' =>'توضیحات نباید خالی باشد',      //ارور اختصاصی

        ]);


        $form=Form::create([
            'user_id' => $_SESSION['id'],
            'type' => 'company',
            'place'   => $_POST['uni'],
            'description'    => $_POST['description'],
            'total_price' => $_SESSION['setprice'],
        ]);



        for ($i=0; $i<count($_POST); $i++){

            if ($this->contains(array_keys($_POST)[$i],'count_')  and array_values($_POST)[$i] > 0){
                //echo array_keys($_POST)[$i]."  ". array_values($_POST)[$i];
                $pieces = explode("_",array_keys($_POST)[$i]);
//                echo $pieces[1];
//                echo array_values($_POST)[$i];
                DB::insert("INSERT INTO `list_tests`(`form_id`, `test_id`, `quantity`) VALUES (?,?,?)"
                    ,array($form->form_id,$pieces[1],array_values($_POST)[$i]));
            }
        }


        DB::insert("INSERT INTO `notification`(`user_id`, `form_id`) VALUES (?,?)",array($_SESSION['id'],$form->form_id));




        return redirect('/home');

    }


    public function contains($str,$search)
    {
        if (strpos($str, $search) !== false) {
            return true;
        }
        return false;
    }

    public function pay()
    {
        return view('pay');
    }


    public function message_user_count()
    {
        $msg_count=DB::table('messages')->where([
            ['status',0],
            ['messageTo',$_SESSION['id']],
        ])->count();


        echo json_encode(array(
            'msgfcount' => $msg_count,
        ));

    }


    public function messageSeen()
    {

        $notif=DB::select("SELECT COUNT(messages.messageId) AS co , users.* , forms.* FROM
  users LEFT OUTER JOIN forms ON users.user_id=forms.user_id LEFT OUTER JOIN messages ON
  messages.form_id=forms.form_id
  WHERE( messages.messageTo = ? and messages.messageFrom = ?  AND messages.status = 0 and forms.finish = 0 )
  GROUP BY forms.form_id ORDER BY COUNT(`messages`.messageId) DESC",array($_SESSION['id'],1));

//have chat

        $valu=array();
        foreach ($notif as $item){
            $valu[] = $item->form_id;
        }

//have not chat

        $notif1=DB::table('users')
            ->leftJoin('forms','users.user_id','=','forms.user_id')
            ->leftJoin('messages','messages.form_id','=','forms.form_id')
            ->where('forms.user_id',$_SESSION['id'])
            ->where('forms.finish','=',0)
            ->whereNotIn('forms.form_id',$valu)->select('users.*' , 'forms.*')
            ->groupBy('forms.form_id')
            ->get();



        return view('msg-user-page',compact('notif','notif1'));

    }

    public function messengerU($form_id)
    {

        $form_id=$this->decode($form_id);

        ////////////////////////////
       $forms=DB::table('forms')->where([
            ['user_id',$_SESSION['id']],
            ['finish',0],
        ])->select('form_id')->get();


       $check=false;

       foreach ($forms as $from){
           if ($from->form_id == $form_id){
               $check=true;
           }
       }

       if (!$check){
           return redirect('/logout');
       }
/////////////////////////////////////////////////


        $_SESSION['form_id']=$form_id;


        DB::table('messages')
            ->where([
                ['form_id',$form_id],
                ['messageTo',$_SESSION['id']]
            ])->update([
                'status'=> 1
            ]);

        $user=DB::table('users')->where('user_id',1)->first();


//        $messages=DB::table('messages')->where([
//            ['form_id',$form_id],
//        ])->get();


        return view('messager-user',compact('user'));

    }

    public function messenger_result_U()
    {

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


    public function userTestDoing()
    {

        $notif=DB::select("SELECT COUNT(messages.messageId) AS co , users.* , forms.* FROM
  users LEFT OUTER JOIN forms ON users.user_id=forms.user_id LEFT OUTER JOIN messages ON
  messages.form_id=forms.form_id
  WHERE( messages.messageTo = ? and messages.messageFrom = ?  AND messages.status = 0 and forms.finish = 0 )
  GROUP BY forms.form_id ORDER BY COUNT(`messages`.messageId) DESC",array($_SESSION['id'],1));

//have chat

        $valu=array();
        foreach ($notif as $item){
            $valu[] = $item->form_id;
        }

//have not chat

        $notif1=DB::table('users')
            ->leftJoin('forms','users.user_id','=','forms.user_id')
            ->leftJoin('messages','messages.form_id','=','forms.form_id')
            ->where('forms.user_id',$_SESSION['id'])
            ->where('forms.finish','=',0)
            ->whereNotIn('forms.form_id',$valu)->select('users.*' , 'forms.*')
            ->groupBy('forms.form_id')
            ->get();


        return view('user-test-doing',compact('notif','notif1'));


    }




    private function decode($value) {
        if (!$value) {
            return false;
        }

        $key = sha1('1234567890987654321');
        $strLen = strlen($value);
        $keyLen = strlen($key);
        $j = 0;
        $decrypttext = '';

        for ($i = 0; $i < $strLen; $i += 2) {
            $ordStr = hexdec(base_convert(strrev(substr($value, $i, 2)), 36, 16));
            if ($j == $keyLen) {
                $j = 0;
            }
            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $decrypttext .= chr($ordStr - $ordKey);
        }

        return $decrypttext;
    }


   private function encode($value) {
        if (!$value) {
            return false;
        }

        $key = sha1('1234567890987654321');
        $strLen = strlen($value);
        $keyLen = strlen($key);
        $j = 0;
        $crypttext = '';

        for ($i = 0; $i < $strLen; $i++) {
            $ordStr = ord(substr($value, $i, 1));
            if ($j == $keyLen) {
                $j = 0;
            }
            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $crypttext .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
        }

        return $crypttext;
    }


}
