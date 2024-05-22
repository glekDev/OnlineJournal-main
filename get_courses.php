<?php
require_once "connectpdo.php";

if(isset($_GET['group_id'])) {
    $group_id = $_GET['group_id'];
    $stmt = $pdo->prepare("SELECT Courses.id, Courses.title FROM Courses JOIN Courses_Groups ON Courses_Groups.course_id = Courses.id WHERE Courses_Groups.group_id = :group_id");
    $stmt->bindParam(':group_id', $group_id);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($courses);
}
?>
