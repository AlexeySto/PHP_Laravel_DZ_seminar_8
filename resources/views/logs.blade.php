<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        td:nth-child(5),td:nth-child(5){text-align: center;}
        table{position: absolute; border-spacing: 0; border-collapse: collapse; width: 78%; box-shadow: 8px 4px 160px rgb(255 255 255 / 25%);}
        td, th{padding: 1px;border: 1px solid #2B2B2B;}
        tr:nth-child(odd) {background-color: #C1B7B7;}
    </style>
    <title>Логи</title>
</head>
<body>
<?php
$db_server = env('DB_HOST');
$db_user = env('DB_USERNAME');
$db_password = env('DB_PASSWORD');
$db_name = env('DB_DATABASE');

try {
    $db = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, time, duration, ip, url, method, input FROM logs";
    
    $statement = $db->prepare($sql); // Инициализация
    $statement->execute();

    $result_array = $statement->fetchAll();

    echo "<div class=\"table\">";
    echo "<table><tr><th>id</th><th>time</th><th>duration</th><th>ip</th><th>url</th><th>method</th><th>input</th></tr>";
    foreach ($result_array as $result_row) {
        echo "<tr>";
        echo "<td align=\"center\">" . $result_row["id"] . "</td>";
        echo "<td align=\"center\">" . $result_row["time"] . "</td>";
        echo "<td align=\"center\">" . $result_row["duration"] . "</td>";
        echo "<td align=\"center\">" . $result_row["ip"] . "</td>";
        echo "<td align=\"center\">" . $result_row["url"] . "</td>";
        echo "<td align=\"center\">" . $result_row["method"] . "</td>";
        echo "<td align=\"center\">" . $result_row["input"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}

catch(PDOException $e) {
    echo "Ошибка при создании записи в базе данных: " . $e->getMessage();
}

$db = null;
?>

</body>
</html>