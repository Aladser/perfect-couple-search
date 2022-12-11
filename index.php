<!DOCTYPE html>
<html lang="en">
<?php include 'scriptes/perfect-partner-search.php'; // задания - функции?>
<?php include 'resources/data.php'; // массив $example_persons_array?>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="resources/icon.ico">
    <link rel="stylesheet" href="css/index.css">
    <title>Идеальный подбор пары</title>
</head>
<body>
    <header class='header'> <h2>Идеальный подбор пары</h2></header>
    <main>
        <?php 
            $person = 'Лермонтов Михаил Юрьевич';
            $personParts = getPartsFromFullname($person);
            echo "<p class='origin-line'>Входная строка: $person </p>"; 
        ?>
        <section class='task'>
            <h3 class='task-header'>Разбиение и объединение ФИО</h3>
            <p><?php 
                echo "getPartsFromFullname: ";
                print_r($personParts); 
                echo "<br>getFullnameFromParts: ";
                echo getFullnameFromParts($personParts); 
            ?></p>
        </section>
        <section class='task'>
            <h3 class='task-header'>Сокращение ФИО</h3>
            <p> <?php echo getShortName($person) ?> </p>
        </section>
        <section class='task'>
            <h3 class='task-header'>Функция определения пола по ФИО</h3>
            <p><?php
                foreach($example_persons_array as $person){
                    $gender = getGenderFromName($person['fullname']);
                    if($gender == 1) $gender = 'мужской пол';
                    else if($gender == -1) $gender = 'женский пол';
                    else $gender = 'неопределенный пол';
                    echo "{$person['fullname']}: $gender<br>";
                }
            ?></p>
        </section>
        <section class='task'>
            <h3 class='task-header'>Определение возрастно-полового состава</h3>
            <p><?php echo getGenderDescription($example_persons_array) ?></p>
        </section>
        <section class='task'>
            <h3 class='task-header'>Идеальный подбор пары</h3>
            <p><?php echo getPerfectPartner($personParts[0], $personParts[1], $personParts[2], $example_persons_array) ?></p>
        </section>
    </main>
</body>
</html>