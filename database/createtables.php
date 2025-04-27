<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path."/attendanceapp/database/database.php";
function clearTable($dbo, $tabName){
    $c="delete from :tabname";
    $s=$dbo->conn->prepare($c);
    try{
        $s->execute([":tabname"=>$tabName]);
    }
    catch(PDOException $oo){

    }
}
$dbo = new Database();

$c="create table student_details 
(
    id int auto_increment primary key,
    roll_no varchar(20) unique,
    name varchar(50)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("student detail created succesfully");
}
catch(PDOException $o)
{
    echo("student detail not created");
}

$c="create table course_details 
(
    id int auto_increment primary key,
    code varchar(20) unique,
    title varchar(50),
    credit int
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("course detail created succesfully");
}
catch(PDOException $o)
{
    echo("course detail not created");
}

$c="create table faculty_details 
(
    id int auto_increment primary key,
    user_name varchar(20) unique,
    name varchar(100),
    password varchar(50)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
    echo("faculty detail created succesfully");
}
catch(PDOException $o)
{
    echo("faculty detail not created");
}

$c="create table session_details 
(
    id int auto_increment primary key,
    year int,
    term varchar(50),
    unique (year, term)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("session detail created succesfully");
}
catch(PDOException $o)
{
    echo("session detail not created");
}

$c="create table course_registration 
(
    student_id int,
    course_id int,
    session_id int,
    primary key (student_id, course_id, session_id)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("course registration created succesfully");
}
catch(PDOException $o)
{
    echo("course registration not created");
}

$c="create table course_allotment 
(
    faculty_id int,
    course_id int,
    session_id int,
    primary key (faculty_id, course_id, session_id)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("course allotment created succesfully");
}
catch(PDOException $o)
{
    echo("course allotment not created");
}

$c="create table attendance_details 
(
    faculty_id int,
    course_id int,
    session_id int,
    student_id int,
    on_date date,
    status varchar(10),
    primary key (faculty_id, course_id, session_id, student_id, on_date)
)";
$s=$dbo->conn->prepare($c);
try{
$s->execute();
echo("attendance datail created succesfully");
}
catch(PDOException $o)
{
    echo("attendance datail not created");
}


$c="insert into student_details 
(id, roll_no, name)
values
(1, 'b-1', 'Vaibhav Pandit'),
(2, 'b-2', 'Tejas Pande'),
(3, 'b-3', 'Atharva Salunke'),
(4, 'b-4', 'Santosh Shirke'),
(5, 'b-5', 'Rohan Kulkarni'),
(6, 'b-6', 'Sneha Patil'),
(7, 'b-7', 'Aditya Jadhav'),
(8, 'b-8', 'Prachi Deshmukh'),
(9, 'b-9', 'Saurabh Shinde'),
(10, 'b-10', 'Pooja Joshi'),
(11, 'b-11', 'Kunal Pawar'),
(12, 'b-12', 'Shreya Shah'),
(13, 'b-13', 'Manish Patil'),
(14, 'b-14', 'Neha Desai'),
(15, 'b-15', 'Omkar Rane'),
(16, 'b-16', 'Rutuja More'),
(17, 'b-17', 'Akash Shetty'),
(18, 'b-18', 'Shruti Kamble'),
(19, 'b-19', 'Nikhil Gawande'),
(20, 'b-20', 'Aishwarya Bhave'),
(21, 'b-21', 'Swapnil Patil'),
(22, 'b-22', 'Mitali Kothari'),
(23, 'b-23', 'Chinmay Kulkarni'),
(24, 'b-24', 'Riya Bhosale')";

$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o)
{
    echo("duplicate entry");
}

$c="insert into faculty_details 
(id, user_name, password, name)
values
(1, 'vaibhav', '123', 'Vaibhav Pandit'),
(2, 'tejas', '234', 'Tejas Pande'),
(3, 'atharva', '345', 'Atharva Salunke')";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o)
{
    echo("duplicate entry");
}

$c="insert into session_details 
(id, year, term)
values
(1, '2025', 'FIFTH SEMESTER'),
(2, '2025', 'SIXTH SEMESTER')";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o)
{
    echo("duplicate entry");
}


$c="insert into course_details 
(id, title, code, credit)
values
(1, 'Database Management', 'CO251', 2),
(2, 'Operating Systems', 'CO252', 4),
(3, 'Computer Networks', 'CO253', 3),
(4, 'Web Technology', 'CO254', 2),
(5, 'Artificial Intelligence', 'CO255', 1),
(6, 'Cloud Computing', 'CO256', 4)";
$s=$dbo->conn->prepare($c);
try{
    $s->execute();
}
catch(PDOException $o)
{
    echo("duplicate entry");
}


clearTable($dbo, "course_registration");
$c="insert into course_registration
(student_id, course_id, session_id)
values
(:sid, :cid, :sessid)";
$s=$dbo->conn->prepare($c);

for($i=1; $i<=24; $i++){
    for($j=0; $j<3; $j++){
        $cid=rand(1,6);

        try{
            $s->execute([":sid"=>$i,":cid"=>$i,":sessid"=>1]);
        }
        catch(PDOException $pe)
        {

        }

        $cid=rand(1,6);
        try{
            $s->execute([":sid"=>$i,":cid"=>$i,":sessid"=>2]);
        }
        catch(PDOException $pe)
        {

        }
    }
}


clearTable($dbo, "course_allotment");
$c="insert into course_allotment
(faculty_id, course_id, session_id)
values
(:fid, :cid, :sessid)";
$s=$dbo->conn->prepare($c);

for($i=1; $i<=6; $i++){
    for($j=0; $j<2; $j++){
        $cid=rand(1,6);

        try{
            $s->execute([":fid"=>$i,":cid"=>$i,":sessid"=>1]);
        }
        catch(PDOException $pe)
        {

        }

        $cid=rand(1,6);
        try{
            $s->execute([":fid"=>$i,":cid"=>$i,":sessid"=>2]);
        }
        catch(PDOException $pe)
        {

        }
    }
}
?>