<?php
session_start();

include_once "config.php";
// $sql = "SELECT `School_id`, `School_Name`, `City_id`,`City_name`, `State`,`Country` FROM `School`";

$sqlid = "SELECT COUNT(`School_id`) as count FROM School";
$count = $conn->query($sqlid);

// $result = $conn->query($sql);

$_SESSION["schoolid"] = $_POST["schoolid"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="school.css">
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
                <p style="  background-color: #ededed;
  color: #3dbce8;
  border-left: 3px solid #3dbce8;" class="sidetext schoollist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/School Listt.png" alt=""><a
                        style="color: #3dbce8;" class="school l" href="school_list.php"> School
                        List</a></p>
            </div>
            <div>
                <p class="sidetext classlist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/Class List.png" alt=""><a class="class l"
                        href="class_list.php"> Class List
                    </a></p>
            </div>
            <div>
                <p class="sidetext studentlist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/Student List.png" alt=""><a class="student l"
                        href="student_list.php"> Student
                        List </a></p>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="nav">
            <p class="list" style="color: #505050;"><b>School List</b></p>
            <p class="total">Total School-<?php while ($rw = $count->fetch_assoc()) {
                                                echo $rw['count'];
                                            } ?></p>
            <input class="inputr" type="text" id="myInput" placeholder="Search">
            <img class="searchpng" src="./School Management/Fresh Schools Management/Search Icon.png" alt="">
        </div>

        <table id="customers">
            <tr>
                <th>School_id</th>
                <th>School_Name</th>
                <th>City_id</th>
                <th> City_name </th>
                <th>State</th>
                <th>Country</th>
                <th> Action</th>
                <th> </th>
            </tr>

            <?php
            $cityid = $_SESSION["cityid"];
            if ($cityid) {
                $sql1 = "SELECT school.School_id,school.School_Name,school.City_id,school.City_name,school.State,school.Country FROM `Citylist` INNER JOIN School on Citylist.City_id= School.City_id where Citylist.City_id=$cityid;";
                $result2 = $conn->query($sql1);

                while ($row = $result2->fetch_assoc()) {

            ?>
            <tbody class="mytable">
                <tr>
                    <td><?php echo  $row["School_id"]; ?></td>
                    <td><?php echo  $row["School_Name"]; ?></td>
                    <td><?php echo  $row["City_id"]; ?></td>
                    <td class="school" data-schoolid='<?php echo  $row["School_id"]; ?>'>
                        <?php echo  $row["City_name"]; ?></td>
                    <td><?php echo  $row["State"]; ?></td>
                    <td><?php echo  $row["Country"]; ?></td>
                    <td style="color: #109cf8;" class="allclass" data-cityid='<?php echo  $row["City_id"]; ?>'>All Class
                    </td>
                    <td style="color: #109cf8;" class="allstudent" data-schoolid='<?php echo  $row["School_id"]; ?>'>All
                        Student</td>
                </tr>
            </tbody>
            <?php
                }
            } else {
                $sql1 = "SELECT `School_id`, `School_Name`, `City_id`,`City_name`, `State`,`Country` FROM `School` ";
                $result2 = $conn->query($sql1);
                while ($row = $result2->fetch_assoc()) {

                ?>
            <tbody class="mytable">
                <tr>
                    <td><?php echo  $row["School_id"]; ?></td>
                    <td><?php echo  $row["School_Name"]; ?></td>
                    <td><?php echo  $row["City_id"]; ?></td>
                    <td class="school" data-schoolid='<?php echo  $row["School_id"]; ?>'>
                        <?php echo  $row["City_name"]; ?></td>
                    <td><?php echo  $row["State"]; ?></td>
                    <td><?php echo  $row["Country"]; ?></td>
                    <td class="allclass" data-schoolid='<?php echo  $row["School_id"]; ?>'>All Class</td>
                    <td class="allstudent" data-schoolid='<?php echo  $row["School_id"]; ?>'>All Student</td>
                </tr>
            </tbody>
            <?php
                }
            }
            ?>

            <div class="no-results" style="display:none">no results found</div>
        </table>

    </div>
    <script>
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


    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".mytable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
    <script src="school.js"></script>
</body>

</html>