<?
use Illuminate\Support\Facades\DB;

function a($formid){

   return DB::table('list_tests')
       ->leftJoin('tests','tests.test_id','=','list_tests.test_id')
           ->where('form_id',$formid)->get();
}

?>

@extends('main')

@section('section')



    <br>
    <a href="/admin_pages" type="button" class="btn btn-dark fonting" style="float: left;margin-left: 10%">بازگشت</a>
    <br>
    <br>
    <h2 class="fonting" style="text-align: center">اعلان ها</h2>
<hr>
        <? foreach ($notif as $noti){ ?>
    <table  style="direction: rtl;width: 85%;border-top: 1px solid crimson" class="table
    table-hover fonting m-auto">
            <colgroup style="border: 1px solid #636b6f">
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 30%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
            </colgroup>

            <tr style="background: cornflowerblue">
                <th class="fonting" style="vertical-align: middle">نام شخص</th>
                <th class="fonting" style="vertical-align: middle">محل</th>
                <th class="fonting" style="vertical-align: middle"> توضیحات تست</th>
                <th class="fonting" style="vertical-align: middle">مبلغ</th>
                <th class="fonting" style="vertical-align: middle">زمان</th>
            </tr>


<tr>

    <td>
        <?=$noti->name?>
    </td>


    <td>
        <?=$noti->place?>
    </td>

    <td>
        <?=$noti->description?>
    </td>

    <td>
        <?=$noti->total_price?>
    </td>

    <td>
        <?=$noti->formOn?>
    </td>

</tr>

 <table  style="direction: rtl;width: 85%;" class="table table-hover fonting m-auto">

                <colgroup style="border: 1px solid #636b6f">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                </colgroup>

            <tr style="background: chartreuse">
                <th class="fonting" style="vertical-align: middle">نام تست</th>
                <th class="fonting" style="vertical-align: middle">تعداد تست</th>
            </tr>
        <? foreach (a($noti->form_id) as $value){ ?>

        <tr>
            <td>
                <?=$value->name?>
            </td>

            <td>
                <?=$value->quantity?>
            </td>
        </tr>
        <?}?>
     <table style="direction: rtl;width: 85%;" class="table table-hover fonting m-auto">
         <colgroup style="border: 1px solid #636b6f">
             <col style="width: 10%;">
         </colgroup>
         <tr>
             <td>
                 <a href="/messenger/<?=$noti->form_id?>/<?=$noti->user_id?>" type="button" class="btn btn-info"><i class="fa fa-envelope" aria-hidden="true"></i>
                     ارسال پیام   <span class="badge badge-light"></span>
                     <span class="sr-only">unread messages</span>
                 </a>
             </td>

         </tr>
     </table>
     <hr>
            </table>


         <?}?>
    </table>


    <br>
    <br>
    <br>

@endsection


