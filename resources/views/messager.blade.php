@extends('main')

@section('section')

    <div class="header-main fonting" style="float: right;text-align: right;direction: rtl;vertical-align: middle;height: 50px">
        <a href="/testDoing" type="button" class="btn btn-dark fonting" style="float: left">بازگشت</a>

    </div>

    <br>
    <br>
<br>

    <div class="board fonting" >

        <?=$user->name?>

        <br>

        <div class="chat_middel">

        {{--<?foreach ($messages as $message){?>--}}
        {{--<?if($message->messageFrom == $_SESSION['id']){--}}


            {{--?>--}}

        {{--<?if($message->message != null){?>--}}
        {{--<div class="right">--}}
            {{--<?=$message->message?>--}}
        {{--</div>--}}
        {{--<?}?>--}}

        {{--<?if($message->messageMedia != null){?>--}}
        {{--<div>--}}
            {{--<img style="width: 140px;height: 140px;position: absolute;right: 7px" src="/telegram/<?=$message['messageImage']?>" alt="">--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<?}?>--}}
        {{--<br>--}}
        {{--<?}else{?>--}}

        {{--<?if($message->message != null){?>--}}
        {{--<div class="left">--}}
            {{--<?=$message->message;?>--}}
        {{--</div>--}}
        {{--<?}?>--}}

        {{--<br>--}}
        {{--<?if($message->messageMedia != null){?>--}}
        {{--<div>--}}
            {{--<img style="width: 140px;height: 140px;position: absolute;left: 7px;" src="/telegram/<?=$message['messageImage']?>" alt="">--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<?}?>--}}

        {{--<br>--}}


        {{--<?}--}}
        {{--}?>--}}

        </div>

        <br>

        <div style="background: #fafafa">

            <form id="messageForm" method="post" enctype="multipart/form-data">
                <div class="row_responsive">
                    <div class="colx-6 form-group" style="vertical-align: middle">
                        <textarea id="text" name="text" style="width: 100%;direction: rtl"></textarea>
                        <small class="form-text text-muted"></small>
                    </div>

                    <div class="colx-1" style="vertical-align: middle">

                        <label style="vertical-align: middle"><span style="vertical-align: middle" class="btn btn-success">آپلود فایل</span>
                            <input value="upload" type="file" id="file" name="file">
                        </label>
                    </div >

                    {{--<input type="hidden" name="formid" value="<?=$form_id?>">--}}
                    <input type="hidden" name="msgTo" value="<?=$user_id?>">

                    <div class="colx-1" style="vertical-align: middle;margin-bottom: 10px">
                        <input type="submit" class="btn btn-primary" value="ارسال" id="send" name="submit">
                    </div>
                </div>


            </form>


        </div>



    </div>


@endsection

@section('js')
    <script src="/js/messanger.min.js?0"></script>

@endsection

@section('css')

    <style>
        html{
            height:100%;/* make sure it is at least as tall as the viewport */
            position:relative;
        }

        body{
            height:100%; /* force the BODY element to match the height of the HTML element */
            background: rgba(255, 248, 220, 0.11);
            position:relative;
        }


        input[type="file"] {
            display: none;
        }

    </style>
@endsection


