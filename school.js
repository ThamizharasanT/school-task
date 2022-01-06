$(".allclass").click(function() {
    var schoolid = $(this).attr("data-schoolid");
    console.log(schoolid);
    var details = {

        'schoolid': schoolid
    };
    $.ajax({
        type:'POST',
        url :'school_list.php',
        data:details,
        success:function(datas) {
            window.location.href="class_list.php";
          

        }

    });

});
$(".allstudent").click(function() {
    var schoolid = $(this).attr("data-schoolid");
    console.log(schoolid);
    var details = {

        'schoolid': schoolid
    };
    $.ajax({
        type:'POST',
        url :'school_list.php',
        data:details,
        success:function(datas) {
            window.location.href="student_list.php";
          

        }

    });

});