
$(function () {


    var x = document.getElementById("myAudio");
    function playAudio() {
        x.play();
    }

   getnitif= function() {


        $.ajax('/notification_count', {
                type: 'post',
                dataType: 'json',
                success: function (data) {

                    if (data.notifcount > 0) {

                        $('#nitifcount').html("   <a href=\"/notifseen\"  type=\"button\" class=\"btn btn-dark\"><i class=\"fa fa-bell\" aria-hidden=\"true\"></i>\n" +
                            "اعلان ها <span class=\"badge badge-light\">" + data.notifcount + "</span>\n" +
                            "                <span class=\"sr-only\">unread messages</span>\n" +
                            "            </a>");

                        var x = document.getElementById("myAudio");

                        playAudio();


                    } else {

                        $('#nitifcount').html("   <button type=\"button\" class=\"btn btn-dark\"><i class=\"fa fa-bell\" aria-hidden=\"true\"></i>\n" +
                            "                اعلان ها <span class=\"badge badge-light\">0</span>\n" +
                            "                <span class=\"sr-only\">unread messages</span>\n" +
                            "            </button>");



                    }

                }
            }
        )

    };

    getnitif();
    setInterval(getnitif,12000);


});