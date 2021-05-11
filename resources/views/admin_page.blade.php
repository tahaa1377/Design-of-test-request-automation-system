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

        <a href="/logout">
            <div class="btn btn-danger fonting float-left" >
                خروج
            </div>
        </a>

    </div>

    <br>
    <br>
    <br>
    <br>

    @if (Session::has('end_form'))
        <div class="alert alert-success fonting" style="direction: rtl">{{ Session::get('end_form') }}</div>
    @endif

    <div class="row_responsive fonting">

        <div class="colx-3">
            <a href="/testDoing" style="text-decoration-line: none">
                <div class="card" style="width: 18rem;">
                    <img height="150px" class="card-img-top" src="/img/testing.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 style="color: black" class="card-text">درخواست های آزمون</h5>
                    </div>
                </div>
            </a>

            <a href="/testDefine" style="text-decoration-line: none">
                <div class="card" style="width: 18rem;">
                    <img height="150px" class="card-img-top" src="/img/add.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 style="color: black" class="card-text">تعریف تست جدید</h5>
                    </div>
                </div>
            </a>
            <a href="/amar" style="text-decoration-line: none">
                <div class="card" style="width: 18rem;">
                    <img height="150px" class="card-img-top" src="/img/amar.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 style="color: black" class="card-text">آمار ها</h5>
                    </div>
                </div>
            </a>
        </div>

    </div>


@endsection

@section('js')

    <script src="/js/notification.min.js?l"></script>
    <script src="/js/msg.min.js?l"></script>

@endsection

@section('css')

    <style>

        .card{
            margin: 6px;
            display: inline-flex;
            cursor: pointer;
            transition: 0.3s;
            transform: translateY(-0.5%);
            border: 1px solid darkgray;
        }

        .card:hover{
            transition: 0.3s;
            box-shadow: 0 0 10px darkgrey;
            transform: translateY(-0.5%);
        }


        body{
            background-color: rgba(223, 255, 250, 0.42);

        }

    </style>
@endsection
