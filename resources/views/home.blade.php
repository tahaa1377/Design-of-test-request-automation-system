@extends('main')

@section('section')




    <div class="header-main">

        <div class="row_responsive fonting">

            <a href="/logout">
            <div class="btn btn-danger fonting float-left" >
                خروج
            </div>
            </a>

            <audio id="myMessage">
                <source src="/sound/msg.mp3" type="audio/mpeg">
            </audio>

            <div style="display: inline-flex;float: right;direction: rtl" id="msgcount">

                <?if($msgcount > 0){?>

                <a href="/messageSeen" type="button" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i>
                    پیام ها <span class="badge badge-light"><?=$msgcount?></span>
                    <span class="sr-only">unread messages</span>
                </a>
                <?}else {?>
                <a href="/userTestDoing" type="button" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i>
                    پیام ها <span class="badge badge-light">0</span>
                    <span class="sr-only">unread messages</span>
                </a>
                <?}?>

            </div>


        </div>
    </div>

    <br>
    <br>
    <br>
    <br>

    <div class="row_responsive fonting">

        <div class="colx-3">

            <a href="/newProjectStudent" style="text-decoration-line: none">
                <div class="card" style="width: 18rem;">
                    <img height="150px" class="card-img-top" src="/img/uni.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 style="color: black" class="card-text">تقاضای تست برای دانشجویان</h5>
                    </div>
                </div>
            </a>

            <a href="/newProjectCompany" style="text-decoration-line: none">

        <div class="card" style="width: 18rem;">
            <img height="150px" class="card-img-top" src="/img/com.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 style="color: black"  class="card-text">تقاضای تست برای شرکت ها</h5>
            </div>
        </div>

            </a>


                <a href="/userTestDoing" style="text-decoration-line: none">
                    <div class="card" style="width: 18rem;">
                        <img height="150px" class="card-img-top" src="/img/testing.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 style="color: black" class="card-text">تست های در حال انجام من</h5>
                        </div>
                    </div>
                </a>

        </div>

    </div>





@endsection

@section('js')

    <script src="/js/message-user.min.js?c"></script>

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

