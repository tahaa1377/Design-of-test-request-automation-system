@extends('main')

@section('section')


    <div class="header-main fonting" style="float: right;text-align: right;direction: rtl;vertical-align: middle">


        <a href="/home" type="button" class="btn btn-dark fonting" style="float: left">بازگشت</a>


    </div>

    <br>
    <br>

    <br>
    <br>
    <div class="form_pro fonting">

        <h4>فرم تست برای دانشجویان</h4>

        <br>


        <form action="/payment_stu" method="post">

            @csrf

            <div class="form-group">
                <input type="text" class="form-control fonting" name="name_family" placeholder="نام و نام خانوادگی">
                <small  class="form-text text-muted"></small>
                <div class="alert-danger fonting">{{$errors->first('name_family')}}</div>
            </div>



            <?
            $_SESSION['setprice']=0;
            ?>



            <div class="form-group">
                <input type="text" class="form-control fonting" name="uni" placeholder="نام دانشگاه">
                <small  class="form-text text-muted"></small>
                <div class="alert-danger fonting">{{$errors->first('uni')}}</div>
            </div>

            <div class="form-group">
                <span style="text-align: right;float: right">شرح تست</span>
                <textarea type="text" class="form-control fonting" name="description" style="height: 100px"></textarea>
                <small  class="form-text text-muted"></small>
                <div class="alert-danger fonting">{{$errors->first('description')}}</div>

            </div>

            <h5>لیست تست ها</h5>

            <table style="direction: rtl" class="table table-hover">

                <colgroup style="border: 1px solid #636b6f">
                    <col style="width: 50%;">
                    <col style="width: 30%;">
                    <col style="width: 2%;">
                    <col style="width: 18%;">
                </colgroup>

                <tr>
                    <th class="fonting" style="vertical-align: middle">نام تست</th>
                    <th class="fonting" style="vertical-align: middle">قیمت تست</th>
                    <th class="fonting" style="vertical-align: middle">انتخاب</th>
                    <th class="fonting" style="vertical-align: middle">تعداد</th>
                </tr>

                <?foreach ($tests as $test){?>
                <tr class="maina">
                    <td>
                        <div><?=$test->name?></div>
                    </td>
                    <td>
                        <div class="prrr"><?=number_format($test->student_price)?></div>
                    </td>
                    <td>
                        <input type="checkbox" name="<?=$test->test_id?>"  value="<?=$test->test_id?>" class="radio_check unactive_s">
                    </td>
                    <td>
                        <div style="border: 1px solid #cdcdcd;border-radius: 5px;padding: 5px 1px">
                            <span class="plus_m"  style="float: right;padding: 2px"><i style="font-size: 105%;vertical-align: middle" class="fa fa-plus"></i></span>
                            <span class="value_m">0</span>
                            <span class="minus_m"  style="float: left;padding: 2px"><i style="font-size: 105%;vertical-align: middle" class="fa fa-minus"></i></span>
                            <input class="value_m_i" type="hidden" name="count_<?=$test->test_id?>"  value="0" >

                        </div>
                    </td>
                </tr>
                <?}?>



            </table>

            <div id="total" style="text-align: right">قیمت نهایی : 0</div>


            <br>


            <div href="/pay" style="text-align: right;float: right">
                <button id="pay_error"  type="submit" class="btn btn-danger" style="vertical-align: middle;direction: ltr">
                    <i class="fa fa-credit-card"></i>&nbsp;&nbsp;
                    <span class="fonting">پرداخت</span></button>
            </div>


        </form>

    </div>

@endsection

@section('css')

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



    </style>
@endsection

@section('js')

    <script>
        $(function () {

            $('#pay_error').hide();


            $(document).on('click','.radio_check',function () {

                // alert("a")

                let control = $(this);
                let parent = control.parentsUntil('.maina').parent();

                if (parent.find('.radio_check').hasClass('unactive_s')){

                    //calcuteTotalPrice();

                    parent.find('.radio_check').addClass("active_s");
                    parent.find('.radio_check').removeClass("unactive_s");
                } else {

                    parent.find('.radio_check').addClass("unactive_s");
                    parent.find('.radio_check').removeClass("active_s");

                    parent.find(".value_m").text(0);
                    parent.find('.value_m_i').val(0);
                    parent.find('.plus_m').removeClass("active_count");
                    parent.find('.minus_m').removeClass("active_count");

                    calcuteTotalPrice();
                }

                if (parent.find('.radio_check').hasClass('active_s')){
                    parent.find('.plus_m').addClass("active_count");
                    parent.find('.minus_m').addClass("active_count");
                    parent.find(".value_m").text(1);
                    parent.find('.value_m_i').val(1);


                    calcuteTotalPrice();
                }

            });

        });


        $(document).on('click','.plus_m',function () {

            if ($(this).hasClass('active_count')) {
                let control = $(this);
                let parent = control.parentsUntil('.maina').parent();
                let quantity=parent.find('.value_m').text();
                quantity=parseInt(quantity);

                quantity++;

                parent.find('.value_m').text(quantity);
                parent.find('.value_m_i').val(quantity);

                calcuteTotalPrice();

            }


        });


        $(document).on('click','.minus_m',function () {
            if ($(this).hasClass('active_count')) {
                let control = $(this);
                let parent = control.parentsUntil('.maina').parent();
                let quantity=parent.find('.value_m').text();
                quantity=parseInt(quantity);

                quantity--;

                if (quantity < 1){
                    parent.find('.value_m').text(1);
                    parent.find('.value_m_i').val(1);

                } else {
                    parent.find('.value_m').text(quantity);
                    parent.find('.value_m_i').val(quantity);

                }

                calcuteTotalPrice();

            }

        });


        function calcuteTotalPrice() {
            var sum=0;
            $('.maina').each(function () {

                let quantity=$(this).find(".value_m").text();
                let price=$(this).find(".prrr").text();

                quantity=parseInt(quantity);
                price=parseInt(price);

                sum+=quantity*price;
            });

            sum*=1000;

            $('#total').text('قیمت نهایی : '+ formatNumber(sum)+" تومان ");

            if (sum === 0){
                $('#pay_error').hide();
            }else {
                $('#pay_error').show();

            }

            $.ajax('/set_price', {
                    type: 'post',
                    data:{
                        price_s:sum
                    },
                    success: function (data) {
                        //alert(data)
                    }
                }
            );

        }

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }


    </script>

@endsection
