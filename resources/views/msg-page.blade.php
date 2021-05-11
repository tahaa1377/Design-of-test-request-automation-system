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
    <h2 class="fonting" style="text-align: center">پیام ها</h2>
    <hr>
    <? foreach ($notif as $noti){ ?>
    <table  style="direction: rtl;width: 85%;border-top: 1.5px solid black;
border-left: 1.5px solid black;border-right: 1.5px solid black" class="table
    table-hover fonting m-auto table-bordered">
        <colgroup style="border: 1px solid #636b6f">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 30%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
        </colgroup>

        <tr style="background: #669ff9">
            <th class="fonting" style="vertical-align: middle">نام شخص</th>
            <th class="fonting" style="vertical-align: middle">محل</th>
            <th class="fonting" style="vertical-align: middle"> توضیحات تست</th>
            <th class="fonting" style="vertical-align: middle">مبلغ</th>
            <th class="fonting" style="vertical-align: middle">زمان</th>
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
                <?=number_format($noti->total_price)?>
            </td>

            <td style="vertical-align: middle">
                <?=$noti->formOn?>
            </td>

        </tr>

        <table  style="direction: rtl;width: 85%;" class="table table-hover fonting m-auto table-striped table-bordered">

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
                    <col style="width: 10%;">
                </colgroup>
                <tr>
                    <td>
                        <a  href="/messenger/<?=$noti->form_id?>/<?=$noti->user_id?>" style="color: white;float: left" type="button" class="btn btn-info"><i class="fa fa-envelope" aria-hidden="true"></i>
                            پیام ها <span class="badge badge-light"><?=$noti->co?></span>
                            <span class="sr-only">unread messages</span>
                        </a>
                    </td>

                    <td>
                        <a onclick="myFunction(<?=$noti->form_id?>)" style="float: right;color: white" type="button" class="btn btn-danger"><i class="fa fa-hourglass-end" aria-hidden="true"></i>
                            اتمام تست
                            <span class="sr-only">unread messages</span>
                        </a>
                    </td>
                </tr>
            </table>
        </table>

        <br>
    </table>
    <div class="container">
        <hr style="background: crimson">
    </div>

    <?}?>


    <? foreach ($notif1 as $noti){ ?>
    <table  style="direction: rtl;width: 85%;border-top: 1px solid crimson" class="table
    table-hover fonting m-auto table-bordered">
        <colgroup style="border: 1px solid #636b6f">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 30%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
        </colgroup>

        <tr style="background: #669ff9">
            <th class="fonting" style="vertical-align: middle">نام شخص</th>
            <th class="fonting" style="vertical-align: middle">محل</th>
            <th class="fonting" style="vertical-align: middle"> توضیحات تست</th>
            <th class="fonting" style="vertical-align: middle">مبلغ</th>
            <th class="fonting" style="vertical-align: middle">زمان</th>
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
                <?=number_format($noti->total_price)?>
            </td>

            <td style="vertical-align: middle">
                <?=$noti->formOn?>
            </td>

        </tr>

        <table  style="direction: rtl;width: 85%;" class="table table-hover fonting m-auto table-striped table-bordered">

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
                    <col style="width: 10%;">
                </colgroup>
                <tr>
                    <td>
                        <a style="float: left" href="/messenger/<?=$noti->form_id?>/<?=$noti->user_id?>" type="button" class="btn btn-info"><i class="fa fa-envelope" aria-hidden="true"></i>
                            پیام ها <span class="badge badge-light">0</span>
                            <span class="sr-only">unread messages</span>
                        </a>
                    </td>

                    <td>
                        <a onclick="myFunction(<?=$noti->form_id?>)" style="float: right;color: white" type="button" class="btn btn-danger"><i class="fa fa-hourglass-end" aria-hidden="true"></i>
                            اتمام تست
                            <span class="sr-only">unread messages</span>
                        </a>
                    </td>
                </tr>
            </table>
        </table>

        <br>
    </table>
    <div>
        <hr style="background: crimson">
    </div>

    <?}?>


    <br>
    <br>
    <br>

@endsection


@section('js')
    <script>
        function myFunction(a) {

            let r = confirm("آیا از اتمام تست اطمینان دارید ؟");
            if (r) {
                location.href= "/finish/"+a
            }
        }
    </script>
@endsection