<!DOCTYPE html>
<html lang="en">
<?php include 'perfect-partner-search.php'; ?>
<?php include 'data.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header> <h2>Идеальный подбор пары</h2></header>
    <main>
        <?php 
            $person = 'Лермонтов Михаил Юрьевич';
            $personParts = getPartsFromFullname($person);
            echo "<p>Входная строка: $person </p>"; 
        ?>
        <section>
            <h3>Разбиение и объединение ФИО</h3>
            <p><?php 
                echo "getPartsFromFullname: ";
                print_r($personParts); 
                echo "<br>getFullnameFromParts: ";
                echo getFullnameFromParts($personParts); 
            ?></p>
        </section>
        <section>
            <h3>Сокращение ФИО</h3>
            <p> <?php echo getShortName($person) ?> </p>
        </section>
        <section>
            <h3>Функция определения пола по ФИО</h3>
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
        <section>
            <h3>Определение возрастно-полового состава</h3>
            <p><?php
                echo getGenderDescription($example_persons_array);
            ?></p>
        </section>
        <section>
            <h3>Идеальный подбор пары</h3>
            <p><?php
                echo getGenderDescription($example_persons_array);
                getPerfectPartner($personParts[0], $personParts[1], $personParts[2], $example_persons_array);
            ?></p>
        </section>
    </main>
</body>
</html>