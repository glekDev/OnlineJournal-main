<?php
require_once "connectpdo.php";

if(isset($_GET['course_title'])) {
    $course_title = $_GET['course_title'];
    $stmt = $pdo->prepare("SELECT Groupss.serial_num FROM Groupss JOIN Courses_Groups ON Groupss.id = Courses_Groups.group_id JOIN Courses ON Courses.id = Courses_Groups.course_id WHERE Courses.title = :course_title");
    $stmt->bindParam(':course_title', $course_title);
    $stmt->execute();
    $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($groups);
}
?>
