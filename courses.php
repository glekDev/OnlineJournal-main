<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Курсы группы</title>
</head>
<body>

<header>
<div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-black">Курсы группы</h1>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <label for="exampleSelect" class="form-label">Найдите курс</label>
                <select class="form-control" id="exampleSelect">
                    <option value="" disabled selected>Type to search...</option>
                    <?php
                        require_once "connectpdo.php";

                        if (isset($_GET['group_id'])) {
                            $group_id = $_GET['group_id'];
                            $stmt = $pdo->prepare("SELECT Courses.* 
                                                    FROM Courses 
                                                    JOIN Courses_Groups ON Courses_Groups.course_id = Courses.id 
                                                    WHERE Courses_Groups.group_id = :group_id");
                            $stmt->bindParam(':group_id', $group_id);
                            $stmt->execute();

                            $courses = array();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $courses[$row['title']] = $row['id'];
                                echo '<option value="' . htmlspecialchars($row['title']) . '">' . htmlspecialchars($row['title']) . '</option>';
                            }
                        }
                    ?>
                </select>
                <button id="popoverButtonC" class="btn base-btn btn-lg" onclick="openClasses()">Открыть занятия</button>
            </div>
        </div>
    </div>
</section>

<footer>
<a href="groups.php" class="btn base-btn btn-lg">Вернуться</a>
    <a href="index.php" class="btn base-btn btn-lg">На главную</a>
</footer>

<script>
    function openClasses() {
        const selectedValue = document.getElementById("exampleSelect").value;
        const selectedClassId = <?php echo json_encode($courses); ?>[selectedValue];
        if (!selectedClassId) {
            alert('Пожалуйста, выберите действительный курс.'); // Fallback for missing popover element
        } else {
            window.location.href = "class.php?id=" + selectedClassId;
        }
    }
</script>

<script>
    // Fetch courses from get_groups.php with group_id parameter
    const urlParams = new URLSearchParams(window.location.search);
    const groupId = urlParams.get('group_id');

    if (groupId) {
        fetch('get_groups.php?group_id=' + groupId)
            .then(response => response.json())
            .then(courses => {
                const select = document.getElementById('exampleSelect');
                courses.forEach(course => {
                    const option = document.createElement('option');
                    option.value = course.title;
                    option.textContent = course.title;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching courses:', error));
    } else {
        console.error('Group ID not provided.');
    }
</script>

</body>
</html>
