$(".allclass").click(function() {
    var classid = $(this).attr("data-classid");


console.log(classid);
    var details = {

        'class_id': classid
    };
    console.log(details.class_id);
    $.ajax({
        type:'POST',
        url :'class_list.php',
        data:details,
        success:function(datas) {
            window.location.href="student_list.php";
          

        }

    });

});


