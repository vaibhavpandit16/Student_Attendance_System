<?php
session_start();
if (isset($_SESSION["current_user"])) 
{
    $facid=$_SESSION["current_user"];
} 
else {
    header("location:" . "/attendanceapp/login.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/attendance.css">
    <title>Document</title>
</head>

<body>
    <div class="page">
        <div class="header-area">
            <div class="logo-area">
                <h2 class="logo">ATTENDANCE APP</h2>
            </div>
            <div class="logout-area"><button class="btnlogout" id="btnLogout">LOGOUT</button></div>
        </div>
        <div class="session-area">
            <div class="label-area"><label>SESSION</label></div>
            <div class="dropdown-area">
                <select class="ddlclass" id="ddlclass">
                    <!-- <option>SELECT ONE</option>
                    <option>2025 AUTUMN</option>
                    <option>2025 SPRING</option> -->
                </select>
            </div>
        </div>

        <div class="classlist-area" id="classlistarea">
            <!-- <div class="classcard">CO251</div>
            <div class="classcard">CO252</div>
            <div class="classcard">CO253</div>
            <div class="classcard">CO254</div>
            <div class="classcard">CO255</div>
            <div class="classcard">CO256</div> -->


        </div>

        <div class="classdetails-area" id="classdetailsarea">
            <!-- <div class="classdetails">
                <div class="code-area">CO251</div>
                <div class="title-area">Database Management</div>
                <div class="ondate-area">
                    <input type="date">
                </div>
            </div> -->
        </div>

        <div class="studentlist-area" id="studentlistarea">
            <!-- <div class="studenttlist"><label>STUDENT LIST</label></div>
            <div class="studentdetails">
                <div class="slno-area">001</div>
                <div class="rollno-area">b-1</div>
                <div class="name-area">Vaibhav Pandit</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">002</div>
                <div class="rollno-area">b-2</div>
                <div class="name-area">Tejas Pande</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">003</div>
                <div class="rollno-area">b-3</div>
                <div class="name-area">Atharva Salunke</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">004</div>
                <div class="rollno-area">b-4</div>
                <div class="name-area">Santosh Shirke</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">005</div>
                <div class="rollno-area">b-5</div>
                <div class="name-area">Rohan Kulkarni</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">006</div>
                <div class="rollno-area">b-6</div>
                <div class="name-area">Sneha Patil</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">007</div>
                <div class="rollno-area">b-7</div>
                <div class="name-area">Aditya Jadhav</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">008</div>
                <div class="rollno-area">b-8</div>
                <div class="name-area">Prachi Deshmukh</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">009</div>
                <div class="rollno-area">b-9</div>
                <div class="name-area">Saurabh Shinde</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">010</div>
                <div class="rollno-area">b-10</div>
                <div class="name-area">Pooja Joshi</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">011</div>
                <div class="rollno-area">b-11</div>
                <div class="name-area">Kunal Pawar</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">012</div>
                <div class="rollno-area">b-12</div>
                <div class="name-area">Shreya Shah</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">013</div>
                <div class="rollno-area">b-13</div>
                <div class="name-area">Manish Patil</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">014</div>
                <div class="rollno-area">b-14</div>
                <div class="name-area">Neha Desai</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">015</div>
                <div class="rollno-area">b-15</div>
                <div class="name-area">Omkar Rane</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">016</div>
                <div class="rollno-area">b-16</div>
                <div class="name-area">Rutuja More</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">017</div>
                <div class="rollno-area">b-17</div>
                <div class="name-area">Akash Shetty</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">018</div>
                <div class="rollno-area">b-18</div>
                <div class="name-area">Shruti Kamble</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">019</div>
                <div class="rollno-area">b-19</div>
                <div class="name-area">Nikhil Gawande</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">020</div>
                <div class="rollno-area">b-20</div>
                <div class="name-area">Aishwarya Bhave</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">021</div>
                <div class="rollno-area">b-21</div>
                <div class="name-area">Swapnil Patil</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">022</div>
                <div class="rollno-area">b-22</div>
                <div class="name-area">Mitali Kothari</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">023</div>
                <div class="rollno-area">b-23</div>
                <div class="name-area">Chinmay Kulkarni</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
            <div class="studentdetails">
                <div class="slno-area">024</div>
                <div class="rollno-area">b-24</div>
                <div class="name-area">Riya Bhosale</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div> -->


        </div>
    </div>
    <input type="hidden" id="hiddenFacId" value=<?php echo($facid) ?>>
    <input type="hidden" id="hiddenSelectedCourseID" value=-1>
    <script src="js/jquery.js"></script>
    <script src="js/attendance.js"></script>
</body>

</html>