<!DOCTYPE html>
<html lang="en">
<?php include 'scriptes/perfect-partner-search.php'; ?>
<?php include 'resources/data.php'; ?>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="resources/icon.ico">
    <link rel="stylesheet" href="css/index.css">
    <title>Идеальный подбор пары</title>
</head>
<body>
    <header class='header'> <h2>Идеальный подбор пары</h2></header>
    <main>
        <section class='task'>
            <form method="POST">
                <h3 class='task__header'>Введите свои данные</h3>
                
                <div class='form-row'>
                    <label for="surname-input" class='form-row__label'>Фамилия:</label>
                    <input type="text" class='for-row__input-text' name='surname' id='surname-input' autocomplete="off">
                </div>
                <div class='form-row'>
                    <label for="name-input" class='form-row__label'>Имя:</label>
                    <input type="text" class='for-row__input-text' name='name' id='name-input' autocomplete="off">
                </div>
                <div class='form-row'>
                    <label for="patronym-input" class='form-row__label'>Отчество:</label>
                    <input type="text" class='for-row__input-text' name='patronym' id='patronym-input' autocomplete="off">
                </div>
                <div class='form-row form-btn-row'>
                    <input class='for-row__btn for-row__btn-submit' type="submit" value='Показать пару'>
                    <input class='for-row__btn for-row__btn-clear' type="button" value='Очистить поля'>
                </div>
            </form>
            
            <?php 
                $surname = isset($_POST['surname']) ? formatName($_POST['surname']) : 'Лермонтов';
                $name = isset($_POST['name']) ? formatName($_POST['name']) : 'Михаил';
                $patronym = isset($_POST['patronym']) ?  formatName($_POST['patronym']) : 'Юрьевич';

                $person;      // полное имя
                $personParts; // массив ФИО
                
                if($surname!='' && $name!='' && $patronym!=''){
                    $person = "$surname $name $patronym";
                    $personParts = getPartsFromFullname($person);
                    echo "<p class='task__username-title'>Пользователь: $person </p>";
                }
                else{
                    $person = '';
                    $personParts = null;
                    echo "<p class='task__username-title'>Пользователь:</p>";
                }
            ?>
        </section>
        <section class='task'>
            <h3 class='task__header'>Гендерный состав аудитории</h3>
            <p><?php echo getGenderDescription($example_persons_array) ?></p>
        </section>
        <section class='task'>
            <h3 class='task__header'>Идеальный подбор пары</h3>
            <p class='task__compatible-container'>
                <?php
                    if($personParts != null) 
                        echo getPerfectPartner($personParts[0], $personParts[1], $personParts[2], $example_persons_array); 
                ?>
            </p>
        </section>
    </main>
</body>
<script src='../scriptes/index.js'></script>
</html>