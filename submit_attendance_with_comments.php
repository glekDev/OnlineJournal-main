<?php
require_once "connectpdo.php";

// Получаем данные из тела POST-запроса
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
}

if (isset($data['attendanceData'])) {
    $attendanceData = $data['attendanceData'];

    // Подготавливаем запрос для обновления данных по посещаемости
    $stmt = $pdo->prepare("UPDATE Attendance SET yn = :yn, comm = :comment WHERE student_id = :student_id AND class_id = :class_id");

    // Проходим по каждой записи и обновляем данные в базе
    try {
        foreach ($attendanceData as $item) {
            $studentId = $item['student_id'];
            $attendanceStatus = $item['yn'];
            $classId = $item['class_id'];
            $comment = $item['comm'];

            // Выполняем запрос с переданными данными
            $stmt->execute([
                ':yn' => $attendanceStatus,
                ':comment' => $comment,
                ':student_id' => $studentId,
                ':class_id' => $classId
            ]);
        }
        echo json_encode(['success' => 'Attendance data successfully submitted']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Attendance data not provided']);
}
?>
