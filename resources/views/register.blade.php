@extends('main')

@section('section')
    <body>
    <div class="main fonting">
        <p class="sign" align="center">پژوهشگاه ارتباطات و فناوری اطلاعات</p>
        @if (Session::has('sign_error'))
            <div class="alert alert-danger fonting">{{ Session::get('sign_error') }}</div>
        @endif
        <form class="form1" action="/registerCheck" method="post">
            @csrf
            <input class="un " type="text" align="center" name="reg_na" value="{{old('reg_na')}}" placeholder="نام کاربری">
            <div class="alert-danger fonting">{{$errors->first('reg_na')}}</div>
            <br>
            <input class="un " type="text" align="center" name="reg_email" value="{{old('reg_email')}}" placeholder="ایمیل">
            <div class="alert-danger fonting">{{$errors->first('reg_email')}}</div>
            <br>
            <input class="pass" type="password" align="center" name="reg_password" placeholder="گذرواژه"><br>
            <div class="alert-danger fonting">{{$errors->first('reg_password')}}</div>
            <br>
            <input type="submit" class="submit" style="color: white;outline: none;" value="ثبت نام"><br><br>
        </form>
        <p class="forgot" ><a href="/login">ورود کاربر</a></p>


    </div>

    </body>

@endsection

@section("css")

    <style>

        body {

            background: url("../img/itrc-back.jpg") no-repeat center center fixed #254e7d;
            background-image: url("../img/itrc-back.jpg");
            background-position-y: center;
            background-position-x: center;
           background-size: cover;
            background-repeat-x: no-repeat;
            background-repeat-y: no-repeat;
            background-attachment: fixed;
            background-origin: initial;
            background-clip: initial;
            background-color: rgb(37, 78, 125);
            font-family: 'Ubuntu', sans-serif;
        }

        .main {
            background-color: #FFFFFF;
            padding-bottom: 10px;
            width: 400px;
            margin: 2em auto;
            border-radius: 1.5em;
            box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
        }

        .sign {
            padding-top: 40px;
            color: #8C55AA;
            font-weight: bold;
            font-size: 23px;
        }

        .un {
            width: 76%;
            text-align: center;
            color: rgb(0, 0, 0);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            background: rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            outline: none;
            box-sizing: border-box;
            border: 2px solid rgba(0, 0, 0, 0.02);
            /*margin-bottom: 50px;*/

            text-align: center;
            /*margin-bottom: 27px;*/
        }

        form.form1 {
            padding-top: 40px;
        }

        .pass {
            width: 76%;
            color: rgb(38, 50, 56);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            background: rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            outline: none;
            box-sizing: border-box;
            border: 2px solid rgba(0, 0, 0, 0.02);
            /*margin-bottom: 50px;*/

            text-align: center;
            /*margin-bottom: 27px;*/
        }


        .un:focus, .pass:focus {
            border: 2px solid rgba(0, 0, 0, 0.18) !important;

        }

        .submit {
            cursor: pointer;
            border-radius: 5em;
            color: #ffffff;
            background: linear-gradient(to right, #c329d7, #E040FB);
            border: 0;
            padding-left: 40px;
            padding-right: 40px;
            padding-bottom: 10px;
            padding-top: 10px;

            font-size: 14px;
            box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
        }

        .forgot {
            text-shadow: 0px 0px 3px rgba(24, 24, 24, 0.12);
            color: #E1BEE7;

        }

        a {
            text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
            color: #5f5364;
            text-decoration: none
        }

        @media (max-width: 600px) {
            .main {
                border-radius: 0px;
            }
        }
    </style>


    @endsection
