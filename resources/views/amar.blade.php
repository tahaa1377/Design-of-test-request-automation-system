<?
use Illuminate\Support\Facades\DB;

function a($formid){

    return DB::table('list_tests')
        ->leftJoin('tests','tests.test_id','=','list_tests.test_id')
        ->where('form_id',$formid)->get();
}

function fetch_documents($formid){

}

?>


@extends('main')

@section('section')


    <div class="header-main fonting" style="float: right;text-align: right;direction: rtl;vertical-align: middle">

    <audio id="myAudio">
        <source src="/sound/ni.mp3" type="audio/mpeg">
    </audio>

    <div style="display: inline-flex" id="nitifcount">

        <?if($notif_count > 0){?>

        <a href="/notifseen" type="button" class="btn btn-dark"><i class="fa fa-bell" aria-hidden="true"></i>
            اعلان ها <span class="badge badge-light"><?=$notif_count?></span>
            <span class="sr-only">unread messages</span>
        </a>
        <?}else {?>
        <button type="button" class="btn btn-dark"><i class="fa fa-bell" aria-hidden="true"></i>
            اعلان ها <span class="badge badge-light">0</span>
            <span class="sr-only">unread messages</span>
        </button>
        <?}?>

    </div>


    <audio id="myMessage">
        <source src="/sound/msg.mp3" type="audio/mpeg">
    </audio>

    <div style="display: inline-flex" id="msgcount">

        <?if($msgcount > 0){?>

        <a href="/msgseen" type="button" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i>
            پیام ها <span class="badge badge-light"><?=$msgcount?></span>
            <span class="sr-only">unread messages</span>
        </a>
        <?}else {?>
        <a href="/testDoing" type="button" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i>
            پیام ها <span class="badge badge-light">0</span>
            <span class="sr-only">unread messages</span>
        </a>
        <?}?>

    </div>

        <a href="/admin_pages" type="button" class="btn btn-dark fonting" style="float: left">بازگشت</a>

    </div>

<br>
<br>
<br>
<br>

    <h2 class="fonting" style="text-align: center">تست های به اتمام رسیده</h2>
    <hr>

    <?
    $total_price=0;
    $counter=0;
    foreach ($notif1 as $noti){
    $counter++;
        ?>

    <div>


    <table  style="direction: rtl;width: 85%;border-top: 1px solid crimson" class="table
    table-hover fonting m-auto table-bordered">
        <colgroup style="border: 1px solid #636b6f">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 30%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
        </colgroup>

        <tr style="background: rgba(102,159,249,0.85);color: black">
            <th class="fonting" style="vertical-align: middle">نام شخص</th>
            <th class="fonting" style="vertical-align: middle">محل</th>
            <th class="fonting" style="vertical-align: middle"> توضیحات تست</th>
            <th class="fonting" style="vertical-align: middle">مبلغ</th>
            <th class="fonting" style="vertical-align: middle">زمان</th>
            <th class="fonting" style="vertical-align: middle">فایل های ضمیمه</th>
        </tr>


        <tr>

            <td style="vertical-align: middle">
                <?=$noti->name?>
            </td>


            <td style="vertical-align: middle">
                <?=$noti->place?>
            </td>

            <td style="vertical-align: middle">
                <?=$noti->description?>
            </td>

            <td style="vertical-align: middle">
                <? $total_price+=$noti->total_price ?>
                <?=number_format($noti->total_price)?>
            </td>

            <td style="vertical-align: middle">
                <?=$noti->formOn?>
            </td>

            <td style="vertical-align: middle">
                <a href="/documents/<?=$noti->form_id?>" class="btn btn-secondary">فایل های ضمیمه</a>
            </td>
        </tr>

        <table  style="direction: rtl;width: 85%;border-top: 1px solid darkgrey" class="table
    table-hover fonting m-auto table-bordered maina">


            <tr>
                <th class="fonting flip" style="vertical-align: middle;float: right;cursor: pointer">جزییات بیشتر</th>
            </tr>



            <table  style="direction: rtl;width: 85%;" class="table table-hover fonting
        m-auto table-striped table-bordered panel">

                <colgroup style="border: 1px solid #636b6f">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                </colgroup>

                <tr style="background: #77ee00">
                    <th class="fonting" style="vertical-align: middle">نام تست</th>
                    <th class="fonting" style="vertical-align: middle">تعداد تست</th>
                </tr>
                <? foreach (a($noti->form_id) as $value){ ?>

                <tr>
                    <td class="aaa">
                        <?=$value->name?>
                    </td>
                    <td>
                        <?=$value->quantity?>
                    </td>
                </tr>
                <?}?>
            </table>


        </table>


        <br>
    </table>


    </div>
    <?}?>

    <div class="fonting" style="background: yellow;font-size: 120%">

        <div style="text-align: right">

            تعداد درخواست کننده:

            <?=($counter)?>

            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            قیمت کل :
        <?=number_format($total_price)?>
        تومان
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        </div>


    </div>

    <br>
    <br>
    <br>
    <br>

@endsection

@section('js')

    <script src="/js/notification.min.js?l"></script>
    <script src="/js/msg.min.js?l"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/hs.min.js"></script>

@endsection