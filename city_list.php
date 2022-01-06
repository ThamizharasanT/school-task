<?php
session_start();
include_once "config.php";
$sql = "SELECT `City_id`, `City_name`, `State`, `Country` FROM `Citylist`";

$_SESSION["cityid"] = $_POST["cityid"];
$sqlid = "SELECT COUNT(`City_id`) as count FROM Citylist";
$count = $conn->query($sqlid);

$result = $conn->query($sql);

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
                <p style="background-color: #ededed;
  color: #225fad;
  border-left: 3px solid #225fad;" class="sidetext clist "><img class="listpng"
                        src="./School Management/Fresh Schools Management/City List.png" alt=""><a
                        style="color: #225fad;" class="city l" href="city_list.php">
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
                <p class="sidetext studentlist"><img class="listpng"
                        src="./School Management/Fresh Schools Management/Student List.png" alt=""><a class="student l"
                        href="student_list.php"> Student
                        List </a></p>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="nav">
            <p class="list" style="color: #505050;"><b>City List</b></p>
            <p class="total">Total Cities -<?php while ($rw = $count->fetch_assoc()) {
                                                echo $rw['count'];
                                            } ?></p>
            <input class="inputr" type="text" id="myInput" placeholder="Search">
            <img class="searchpng" src="./School Management/Fresh Schools Management/Search Icon.png" alt="">
        </div>


        <table id="customers">
            <tr>
                <th>City_id</th>
                <th>City_Name</th>
                <th>State</th>
                <th>Country</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {

            ?>
            <tbody class="mytable">
                <tr>
                    <td><?php echo  $row["City_id"]; ?></td>
                    <td style="color: #109cf8;" class="cityname" data-cityid="<?php echo  $row["City_id"]; ?>">
                        <?php echo  $row["City_name"]; ?>
                    </td>
                    <td><?php echo  $row["State"]; ?></td>
                    <td><?php echo  $row["Country"]; ?></td>
                </tr>
            </tbody>

            <?php
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
    <script src="city.js"></script>
</body>

</html>