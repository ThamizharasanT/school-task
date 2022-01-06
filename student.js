$(".input").click(function(e) {
    var ageid = $(this).val();
    console.log(ageid);
    e.preventDefault();
    var details = {

        'ageid': ageid
    };
    $.ajax({
        type:'POST',
        url :'class_list.php',
        data:details,
        success:function(datas) {
            window.location.href="student_list.php";
          

        }

    });

});