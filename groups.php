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
    <title>Список групп</title>
</head>
<body>

<header>
<div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-black">Группы</h1>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <label for="exampleDataList" class="form-label">Найдите группу</label>
                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                <datalist id="datalistOptions">
                <?php
                        require_once "connectpdo.php";

                        $getst = "SELECT id, serial_num FROM Groupss GROUP BY serial_num";
                        $stmt = $pdo->prepare($getst);
                        $stmt->execute();

                        $groups = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $groups[$row['serial_num']] = $row['id'];
    echo '<option value="' . $row['serial_num'] . '">' . htmlspecialchars($row['serial_num']) . '</option>';
}


                    ?>
                </datalist>
                <button id="popoverButtonC" class="btn base-btn btn-lg" onclick="openCourses()">Открыть курсы</button>
            </div>
        </div>
    </div>
</section>

<footer>
<a href="index.php" class="btn base-btn btn-lg">Вернуться</a>
    <a href="index.php" class="btn base-btn btn-lg">На главную</a>
</footer>

<script>
    const popoverButtonG = document.getElementById('popoverButtonG');
    const popover = new bootstrap.Popover(popoverButtonG, {
        container: 'body' // Ensure popover is displayed properly
    });

    function openCourses() {
    const selectedValue = document.getElementById("exampleDataList").value;
    const selectedSerialNum = selectedValue.split('|')[0]; // Extract serial number
    const selectedGroupId = <?php echo json_encode($groups); ?>[selectedSerialNum];
    if (!selectedGroupId) {
        popover.show();
    } else {
        window.location.href = "courses.php?group_id=" + selectedGroupId;
    }
}
</script>

<script>
    // Fetch groups from get_groups.php
    fetch('get_groups.php')
        .then(response => response.json())
        .then(groups => {
            const datalist = document.getElementById('datalistOptions');
            groups.forEach(group => {
                const option = document.createElement('option');
                option.value = group;
                datalist.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching groups:', error));
</script>

</body>
</html>




















