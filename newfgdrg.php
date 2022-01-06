<!-- <!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<body>


    <script>

        $(function () {
            $('input[name="test"]').on('change', function (a, b) {
                var value = this.value;
                $('#ul1 >li').hide();
                if (value == 'All') {
                    $('#ul1 >li').show();
                }
                if (value == 'Under 10$') {
                    $('#ul1 >li').filter(function (a, b) {
                        var v = b.value;
                        return 10 > v;
                    }).show();
                }
                if (value == 'Between 10$ - 20$') {
                    $('#ul1 >li').filter(function (a, b) {
                        var v = b.value;
                        return v>=10 && v <= 20;
                    }).show();
                }
            });
        });


    </script>

    <input type="radio" value="All" checked name="test"><label>All</label>
    <input type="radio" value="Under 10$" name="test"><label> Under 10$</label>
    <input type="radio" value="Between 10$ - 20$" name="test"><label>Between 10$ - 20$</label>

    <ul id="ul1">
        <li value=6.67>costs 6.67$</li>
        <li value=15>costs 15$</li>
        <li value=19>costs 19$</li>
    </ul>

</body>
</html> -->
<?php

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 2;
$offset = ($pageno - 1) * $no_of_records_per_page;
$conn = mysqli_connect("localhost", "root", "root", "school");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

$total_pages_sql = "SELECT COUNT(*) FROM Student";
$result = mysqli_query($conn, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
$sql = "SELECT * FROM Student LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($conn, $sql);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="school.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body style=" background-color:#f3f7fa;">
    <div class="logo">
        <img class="logo_png" src="./School Management/Fresh Schools Management/Logo.png" alt="">
    </div>
    <div class="vertical">
        <div class="vertical_text">
            <div>
                <div>
                    <p class="school_management">SCHOOL MANAGEMENT</p>
                </div>
                <p class="sidetext clist "><img class="listpng"
                        src="./School Management/Fresh Schools Management/City List.png" alt=""><a class="city"
                        href="city_list.php">
                        City
                        List</a></p>
            </div>

            <div>
                <p class="sidetext schoollist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/School Listt.png" alt=""><a class="school"
                        href="school_list.php"> School
                        List</a></p>
            </div>
            <div>
                <p class="sidetext classlist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/Class List.png" alt=""><a class="class"
                        href="class_list.php"> Class List
                    </a></p>
            </div>
            <div>
                <p class="sidetext studentlist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/Student List.png" alt=""><a class="student"
                        href="student_list.php"> Student
                        List </a></p>
            </div>
        </div>
    </div>
    <div class="main">

        <div class="nav">

            <p class="list" style="color: #505050;"><b>Student List</b></p>
            <p class="total">Total Student-<?php while ($rw = $count->fetch_assoc()) {
                                                echo $rw['count'];
                                            } ?></p>
            <input class="inputr" type="text" id="myInput" placeholder="Search">
            <img class="searchpng" src="./School Management/Fresh Schools Management/Search Icon.png" alt="">
            <img id="filter" src="./School Management/Fresh Schools Management/Filter.png" alt="">



            <button class='filter' onclick="myFunc()"><img src="./Assets/Filter.png" alt="" id="filter">Filter</button>
            <div class="dropdown">
                <div class="myfilter" id="filter-content">

                    <p class='age'>Age</p>
                    <input type="radio" class='input' id='1' name='filter' value="1">3 to 5
                    <input type="radio" class='input' id='2' name='filter' value="2">6 to 9
                    <input type="radio" class='input' id='3' name='filter' value="3">10 to 12
                    <input type="radio" class="input" id='4' name='filter' value="4">13 to 15
                    <input type="radio" class="input" id='5' name='filter' value="5">16 to 18

                </div>
            </div>




        </div>

        <table id="customers">
            <tr>
                <th>Student_id</th>
                <th>Student_Name</th>
                <th>age</th>
                <th>gender</th>
                <th>Father_Name</th>
                <th>Mobile_Number</th>
                <th>Class_id</th>
                <th>City_id</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($res_data)) {


            ?>
            <tbody id="mytable">
                <tr>
                    <td><?php echo  $row["Student id"]; ?></td>
                    <td><?php echo  $row["Student_Name"]; ?></td>
                    <td><?php echo  $row["age"]; ?></td>
                    <td><?php echo  $row["gender"]; ?></td>
                    <td><?php echo  $row["Father_Name"]; ?></td>
                    <td><?php echo  $row["Mobile_Number"]; ?></td>
                    <td><?php echo  $row["Class_id"]; ?></td>
                    <td><?php echo  $row["City_id"]; ?></td>
                </tr>
            </tbody>
            <?php
            }


            ?>

        </table>

        <ul class="pagination">
            <li><a href="?pageno=1">First</a></li>
            <li class="<?php if ($pageno <= 1) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($pageno <= 1) {
                                echo '#';
                            } else {
                                echo "?pageno=" . ($pageno - 1);
                            } ?>">Prev</a>
            </li>
            <li class="<?php if ($pageno >= $total_pages) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($pageno >= $total_pages) {
                                echo '#';
                            } else {
                                echo "?pageno=" . ($pageno + 1);
                            } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>

    </div>

    <script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#mytable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function myFunc() {
        document.getElementById("filter-content").classList.toggle("show");

    }
    let values = $("#1").vel();
    console.log(values);
    </script>


</body>

</html>