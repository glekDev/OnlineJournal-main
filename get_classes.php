<?php
require_once "connectpdo.php";

if(isset($_GET['course_title']) && isset($_GET['group_serial'])) {
    $course_title = $_GET['course_title'];
    $group_serial = $_GET['group_serial'];
    $stmt = $pdo->prepare("SELECT Classes.id, Classes.period, Classes.topic FROM Classes JOIN Courses_Groups ON Classes.course_group_id = Courses_Groups.id JOIN Courses ON Courses.id = Courses_Groups.course_id JOIN Groupss ON Groupss.id = Courses_Groups.group_id WHERE Courses.title = :course_title AND Groupss.serial_num = :group_serial");
    $stmt->bindParam(':course_title', $course_title);
    $stmt->bindParam(':group_serial', $group_serial);
    $stmt->execute();
    $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($classes);
}
?>
