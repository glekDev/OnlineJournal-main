<?php
require_once "connectpdo.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $class_id = $_POST['class_id'];
    $yn = $_POST['yn'];

    // Проверка существования записи
    $checkStmt = $pdo->prepare("SELECT * FROM Attendance WHERE student_id = :student_id AND class_id = :class_id");
    $checkStmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
    $checkStmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        // Обновление существующей записи
        $updateStmt = $pdo->prepare("UPDATE Attendance SET yn = :yn WHERE student_id = :student_id AND class_id = :class_id");
        $updateStmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $updateStmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
        $updateStmt->bindParam(':yn', $yn, PDO::PARAM_INT);
        $updateStmt->execute();
    } else {
        // Вставка новой записи
        $insertStmt = $pdo->prepare("INSERT INTO Attendance (student_id, class_id, yn) VALUES (:student_id, :class_id, :yn)");
        $insertStmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $insertStmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
        $insertStmt->bindParam(':yn', $yn, PDO::PARAM_INT);
        $insertStmt->execute();
    }

    // Возвращаем успешный ответ
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
