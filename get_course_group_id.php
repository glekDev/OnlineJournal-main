<?php
require_once "connectpdo.php";

if(isset($_GET['course_title']) && isset($_GET['group_serial'])) {
    $course_title = $_GET['course_title'];
    $group_serial = $_GET['group_serial'];
    $stmt = $pdo->prepare("SELECT id FROM Courses_Groups JOIN Courses ON Courses.id = Courses_Groups.course_id JOIN Groupss ON Groupss.id = Courses_Groups.group_id WHERE Courses.title = :course_title AND Groupss.id = :group_serial");
    $stmt->bindParam(':course_title', $course_title);
    $stmt->bindParam(':group_serial', $group_serial);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode(['course_group_id' => $result ? $result['id'] : null]);
}
?>
