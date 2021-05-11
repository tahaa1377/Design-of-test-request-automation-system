@extends('main')

@section('section')


    <div style="background: white;padding: 7px">
    <h2 class="fonting" style="direction: rtl">آزمایشگاه های CT</h2>
    </div>


    <div class="fonting" style="color: white;text-align: right;margin-right: 20px;margin-top: 10px">
        <h2>تست های قابل انجام</h2>
        <ul style="direction: rtl">
            @foreach($tests as $test)
            <li><?=$test->name?></li>
            @endforeach
        </ul>
    </div>




    <h3  class="fonting" style="background: yellow;color: black;padding: 7px;margin-top: 20px;height: 100%">

        <span>برای وقت گیری و هزینه های تست <a href="/login" style="color: red">وارد </a>سامانه شوید یا <a href="/register" style="color: red">ثبت نام</a> کنید</span>

        <br>

    </h3>

@endsection

@section('css')

    <style>
        body {

            background: url("../img/itrc-back.jpg") no-repeat center center fixed #254e7d;
            background-image: url("../img/itrc-back.jpg");
            background-position-x: center;
            background-position-y: center;
            background-size: cover;
            background-repeat-x: no-repeat;
            background-repeat-y: no-repeat;
            background-attachment: fixed;
            background-origin: initial;
            background-clip: initial;
            background-color: rgb(37, 78, 125);
            font-family: 'Ubuntu', sans-serif;
        }
    </style>
    @endsection