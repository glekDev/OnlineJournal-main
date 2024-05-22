<?php
require_once "connectpdo.php";

if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    
    // Получаем group_id из таблицы Classes
    $stmt = $pdo->prepare("SELECT c.course_group_id, cg.group_id FROM Classes c JOIN Courses_Groups cg ON c.course_group_id = cg.id WHERE c.id = :class_id");
    $stmt->bindParam(':class_id', $class_id);
    $stmt->execute();
    $classData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($classData) {
        $group_id = $classData['group_id'];
        
        // Запрашиваем студентов только из выбранной группы
        $stmt = $pdo->prepare("SELECT s.id AS student_id, s.first_name, s.last_name, a.yn, a.comm 
                               FROM students s 
                               LEFT JOIN Attendance a ON s.id = a.student_id AND a.class_id = :class_id
                               WHERE s.group_id = :group_id");
        $stmt->bindParam(':class_id', $class_id);
        $stmt->bindParam(':group_id', $group_id);
        $stmt->execute();
        $attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($attendance);
    } else {
        echo json_encode(['error' => 'Class not found']);
    }
} else {
    echo json_encode(['error' => 'Missing class_id']);
}
?>
