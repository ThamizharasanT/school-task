<?php
session_start();

include_once "config.php";
$results_per_page = 7;
$sql = "SELECT `Student id`, `Student_Name`, `age`,`gender`, `Father_Name`, `Mobile_Number`, `Class_id`, `City_id` FROM `Student`";

$sqlid = "SELECT COUNT(`Student id`) as count FROM Student";
$count = $conn->query($sqlid);

$result = $conn->query($sql);
$numofresult = mysqli_num_rows($result);
$numofpages = ceil($numofresult / $results_per_page);
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$pageresult = ($page - 1) * $results_per_page;

// echo $sql1;
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
                        src="./School Management/Fresh Schools Management/City List.png" alt=""><a class="city l"
                        href="city_list.php">
                        City
                        List</a></p>
            </div>

            <div>
                <p class="sidetext schoollist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/School Listt.png" alt=""><a class="school l"
                        href="school_list.php"> School
                        List</a></p>
            </div>
            <div>
                <p class="sidetext classlist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/Class List.png" alt=""><a class="class l"
                        href="class_list.php"> Class List
                    </a></p>
            </div>
            <div>
                <p style="background-color: #ededed;
  
  border-left: 3px solid #d642c8;" class="sidetext studentlist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/Student List.png" alt=""><a
                        style="color: #d642c8;" class="student l" href="student_list.php"> Student
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
                    <input type="radio" class='input' id='1' name='filter' value="'13'and'15'">3 to 5
                    <input type="radio" class='input' id='2' name='filter' value="'3'and'5'">6 to 9
                    <input type="radio" class='input' id='3' name='filter' value="'3'and'5'">10 to 12
                    <input type="radio" class="input" id='4' name='filter' value="'3'and'5'">13 to 15
                    <input type="radio" class="input" id='5' name='filter' value="'3'and'5'">16 to 18

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
            $classid = $_SESSION["classid"];
            $schoolid = $_SESSION["schoolid"];
            $ageid = $_SESSION["ageid"];
            if ($classid) {
                $sql1 = "SELECT Student.`Student_Name`,Student.`Student id`,Student.`age`,Student.`gender`,Student.`Father_Name`,Student.`Mobile_Number`,Student.`Class_id`,Student.City_id FROM Class INNER JOIN Student on Student.`Class_id` = Class.`Class_id` where class.`Class_id`= $classid ";
                $result2 = $conn->query($sql1);

                while ($row = $result2->fetch_assoc()) {

            ?>
            <tbody class="mytable">
                <tr>
                    <td><?php echo  $row["Student id"]; ?></td>
                    <td><?php echo  $row["Student_Name"]; ?></td>
                    <td id="age"><?php echo  $row["age"]; ?></td>
                    <td><?php echo  $row["gender"]; ?></td>
                    <td><?php echo  $row["Father_Name"]; ?></td>
                    <td><?php echo  $row["Mobile_Number"]; ?></td>
                    <td><?php echo  $row["Class_id"]; ?></td>
                    <td><?php echo  $row["City_id"]; ?></td>
                </tr>
            </tbody>
            <?php
                }
            } elseif ($schoolid) {
                $sql1 = "SELECT * FROM ((Student INNER JOIN Class ON Student.Class_id=Class.Class_id) INNER JOIN School ON Class.Class_id=School.School_id) WHERE School.School_id=$schoolid";
                $result2 = $conn->query($sql1);
                while ($row = $result2->fetch_assoc()) {

                ?>
            <tbody class="mytable">
                <tr>
                    <td><?php echo  $row["Student id"]; ?></td>
                    <td><?php echo  $row["Student_Name"]; ?></td>
                    <td id="age"><?php echo  $row["age"]; ?></td>
                    <td><?php echo  $row["gender"]; ?></td>
                    <td><?php echo  $row["Father_Name"]; ?></td>
                    <td><?php echo  $row["Mobile_Number"]; ?></td>
                    <td><?php echo  $row["Class_id"]; ?></td>
                    <td><?php echo  $row["City_id"]; ?></td>
                </tr>
            </tbody>
            <?php
                }
            } elseif ($ageid) {
                $sql1 = "SELECT * FROM `Student` WHERE age BETWEEN $ageid";
                $result2 = $conn->query($sql1);
                while ($row = $result2->fetch_assoc()) {

                ?>
            <tbody class="mytable">
                <tr>
                    <td><?php echo  $row["Student id"]; ?></td>
                    <td><?php echo  $row["Student_Name"]; ?></td>
                    <td id="age"><?php echo  $row["age"]; ?></td>
                    <td><?php echo  $row["gender"]; ?></td>
                    <td><?php echo  $row["Father_Name"]; ?></td>
                    <td><?php echo  $row["Mobile_Number"]; ?></td>
                    <td><?php echo  $row["Class_id"]; ?></td>
                    <td><?php echo  $row["City_id"]; ?></td>
                </tr>
            </tbody>
            <?php
                }
            } else {
                $sql1 = 'SELECT * FROM student LIMIT ' . $pageresult . ',' . $results_per_page;
                $result2 = $conn->query($sql1);
                while ($row = $result2->fetch_assoc()) {

                ?>
            <tbody class="mytable">
                <tr>
                    <td><?php echo  $row["Student id"]; ?></td>
                    <td><?php echo  $row["Student_Name"]; ?></td>
                    <td id="age"><?php echo  $row["age"]; ?></td>
                    <td><?php echo  $row["gender"]; ?></td>
                    <td><?php echo  $row["Father_Name"]; ?></td>
                    <td><?php echo  $row["Mobile_Number"]; ?></td>
                    <td><?php echo  $row["Class_id"]; ?></td>
                    <td><?php echo  $row["City_id"]; ?></td>
                </tr>
            </tbody>
            <?php
                }
            }
            ?>

            <div class="no-results" style="display:none">no results found</div>

        </table>
        <?php

        for ($page = 1; $page <= $numofpages; $page++) {
        ?>
        <a class="bage" href="<?php echo 'student_list.php?page=' . $page; ?>">
            <?php
                echo $page;
                ?>
        </a>
        <?php
        }
        ?>

    </div>

    <script>
    // $(document).ready(function() {
    //     $("#myInput").on("keyup", function() {
    //         var value = $(this).val().toLowerCase();
    //         $(".mytable tr").filter(function() {
    //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //         });
    //     });
    // });


    $(document).ready(function() {
        var $block = $('.no-results');
        $("#myInput").keyup(function() {
            var isMatch = false;
            var value = $(this).val();
            $(".mytable tr").each(function() {
                var content = $(this).html();
                if (content.toLowerCase().indexOf(value) == -1) {
                    $(this).hide();
                } else {
                    isMatch = true;
                    $(this).show();
                }
            });
            $block.toggle(!isMatch);
        });
    });

    function myFunc() {
        document.getElementById("filter-content").classList.toggle("show");

    }

    $("tbody").click(function() {
        console.log($(this).find(".city").attr("data-schoolId"));
    });
    </script>

    <script src="student.js"></script>
</body>

</html>