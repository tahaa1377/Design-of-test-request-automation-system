$(function () {

    $(".panel").hide();
    $(document).on('click','.flip',function () {

        let control=$(this);
        let parent = control.parentsUntil('.maina').parent().parent();

        if (parent.find(".panel").hasClass('show')) {

            parent.find(".panel").hide('slow');
            parent.find(".panel").removeClass("show");

        }else {

            parent.find(".panel").show('slow');
            parent.find(".panel").addClass("show");


        }

    });



});
