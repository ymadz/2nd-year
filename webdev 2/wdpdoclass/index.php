<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>praktis</title>
    <?php
        require_once "classes/database.php";
        require_once "classes/student.php";
    ?>
</head>
<body>
    <?php
        $objStudent = new Student;
        $students = $objStudent->getData();
    ?>

    <table>
        <tr>
            <th>studentID</th>
            <th>Name</th>
            <th>Gender</th>
        </tr>
        <?php
            foreach ($students as $student) { ?> 
                <tr>
                    <td><?php echo $student["studentID"]?></td>
                    <td><?php echo $student["lastName"] .", " . $student["firstName"]?></td>
                    <td><?php echo $student["gender"]?></td>
                </tr>
        <?php };?>
    </table>
</body>
</html>