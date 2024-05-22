<?php
require_once "connectpdo.php";

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
}

if (isset($data['course_title']) && isset($data['group_serial']) && isset($data['period']) && isset($data['topic'])) {
    $courseTitle = $data['course_title'];
    $groupSerial = $data['group_serial'];
    $period = $data['period'];
    $topic = $data['topic'];

    try {
        // Получить course_id и group_id
        $stmt = $pdo->prepare("SELECT id FROM Courses WHERE title = :course_title");
        $stmt->execute([':course_title' => $courseTitle]);
        $courseId = $stmt->fetchColumn();

        $stmt = $pdo->prepare("SELECT id FROM Groupss WHERE serial_num = :group_serial");
        $stmt->execute([':group_serial' => $groupSerial]);
        $groupId = $stmt->fetchColumn();

        if ($courseId && $groupId) {
            // Получить course_group_id
            $stmt = $pdo->prepare("SELECT id FROM Courses_Groups WHERE course_id = :course_id AND group_id = :group_id");
            $stmt->execute([
                ':course_id' => $courseId,
                ':group_id' => $groupId
            ]);
            $courseGroupId = $stmt->fetchColumn();

            if ($courseGroupId) {
                // Добавить новое занятие
                $stmt = $pdo->prepare("INSERT INTO Classes (period, course_group_id, topic) VALUES (:period, :course_group_id, :topic)");
                $stmt->execute([
                    ':period' => $period,
                    ':course_group_id' => $courseGroupId,
                    ':topic' => $topic
                ]);

                echo json_encode(['success' => 'Class added successfully']);
            } else {
                echo json_encode(['error' => 'Course group not found']);
            }
        } else {
            echo json_encode(['error' => 'Course or group not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Missing required fields']);
}
?>
