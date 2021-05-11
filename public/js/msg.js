
$(function () {


    var x1 = document.getElementById("myMessage");
    function playAudio() {
        x1.play();
    }


    getMsg= function() {

        $.ajax('/message_count', {
                type: 'post',
                dataType: 'json',
                success: function (data) {


                    if (data.msgfcount > 0) {

                        $('#msgcount').html("  <a href=\"/msgseen\" type=\"button\" class=\"btn btn-primary\"><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i>\n" +
                            "            پیام ها <span class=\"badge badge-light\">"+ data.msgfcount +"</span>\n" +
                            "            <span class=\"sr-only\">unread messages</span>\n" +
                            "        </a>");


                       // var x1 = document.getElementById("myMessage");

                        playAudio();


                    } else {

                        $('#msgcount').html("   <a href='/testDoing' type=\"button\" class=\"btn btn-primary\"><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i>\n" +
                            "            پیام ها <span class=\"badge badge-light\">0</span>\n" +
                            "            <span class=\"sr-only\">unread messages</span>\n" +
                            "        </a>");

                    }

                }
            }
        )

    };

    getMsg();
    setInterval(getMsg,10000);


});