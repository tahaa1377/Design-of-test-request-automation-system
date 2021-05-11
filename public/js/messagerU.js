$(function () {

    getmessages=function () {


        $.ajax('/messenger_result_U', {
                type: 'post',
                success: function (data) {

                    $('.chat_middel').html(data);

                    if (autoscroll){
                        scrolldwon();
                    }
                    $('.chat_middel').on('scroll',function () {

                        if ($(this).scrollTop()<this.scrollHeight-$(this).height()) {
                            autoscroll=false;
                        }else {
                            autoscroll=true;
                        }
                    });


                }
            }
        )

    };
    autoscroll=true;
    scrolldwon=function(){
        $('.chat_middel').scrollTop($('.chat_middel')[0].scrollHeight);
    };

    getmessages();
    $timer=setInterval(getmessages,3000);





    $(document).on('submit','#messageForm',function (e) {


        e.preventDefault();
        var form=new FormData ($(this)[0]);
        form.append('file', $('#file')[0].files[0]);

        // console.log($('#file')[0]);
        // console.log(form);

        $.ajax('/sendMsg_U', {
                type: 'post',
                data: form,
                success: function (data) {
                    getmessages();
                    $('#text').val("");
                    $('#file').val(null);

                },
                cache:false,
                contentType:false,
                processData:false
            }
        );


        ///////////////////in vase inke har vaght ok zad scroll bechasbe be akhar
        autoscroll=true;
        scrolldwon=function(){
            $('.chat_middel').scrollTop($('.chat_middel')[0].scrollHeight);
        };
/////////////////////////////////

    });


    $('#text').keypress(function (e) {
        if (e.which === 13) {

            $('#messageForm').submit();
            e.preventDefault();
            var form=new FormData ($(this)[0]);
            form.append('file', $('#file')[0].files[0]);

            // console.log($('#file')[0]);
            // console.log(form);

            $.ajax('/sendMsg_U', {
                    type: 'post',
                    data: form,
                    success: function () {
                        getmessages();
                        $('#text').val("");
                        $('#file').val(null);

                    },
                    cache:false,
                    contentType:false,
                    processData:false
                }
            );


            ///////////////////in vase inke har vaght ok zad scroll bechasbe be akhar
            autoscroll=true;
            scrolldwon=function(){
                $('.chat_middel').scrollTop($('.chat_middel')[0].scrollHeight);
            };
/////////////////////////////////

        }
    });


});