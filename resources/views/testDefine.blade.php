@extends('main')

@section('section')



    <br>
    <a href="/admin_pages" type="button" class="btn btn-dark fonting" style="float: left;margin-left: 10%">بازگشت</a>
    <br>
    <br>
    <h2 class="fonting" style="text-align: center">تعریف تست جدید</h2>
    <hr>
    <div class="form_pro fonting">

    <form action="/test_define_form" method="post">

        @csrf

        <div class="form-group">
            <input type="text" class="form-control fonting" name="name_test" placeholder="نام تست">
            <small  class="form-text text-muted"></small>
            <div class="alert-danger fonting">{{$errors->first('name_test')}}</div>
        </div>


        <div class="form-group">
            <input type="number" class="form-control fonting" name="test_price_student" placeholder="قیمت تست برای دانشجویان">
            <small  class="form-text text-muted"></small>
            <div class="alert-danger fonting">{{$errors->first('test_price_student')}}</div>
        </div>

        <div class="form-group">
            <input type="number" class="form-control fonting" name="test_price_company" placeholder="قیمت تست برای شرکت ها">
            <small  class="form-text text-muted"></small>
            <div class="alert-danger fonting">{{$errors->first('test_price_company')}}</div>
        </div>





        <br>


        <div style="text-align: right;float: right">
            <button id="pay_error"  type="submit" class="btn btn-success" style="vertical-align: middle;direction: ltr">
                <span class="fonting">تایید</span></button>
        </div>
<br>

    </form>

    </div>
@endsection

@section('js')


@endsection

@section('css')

    <style>

    </style>
@endsection

