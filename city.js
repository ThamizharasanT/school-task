$(".cityname").click(function() {
    var cityid = $(this).attr("data-cityid");
    var details = {

        'cityid': cityid
    };
    $.ajax({
        type:'POST',
        url :'city_list.php',
        data:details,
        success:function(datas) {
            window.location.href="school_list.php";
          

        }

    });

});