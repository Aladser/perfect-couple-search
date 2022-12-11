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
        <section class='task form-container'>
            <form class='data-form' method="POST">
                <h3 class='task-header form-header'>Введите свои данные</h3>
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
                <div class='form-row buttons-row'>
                    <input class='for-row__btn for-row__btn-submit' type="submit" value='Показать пару'>
                    <input class='for-row__btn for-row__btn-clear' type="button" value='Очистить поля'>
                </div>
            </form>
            
            <?php 
                $surname = isset($_POST['surname']) ? $_POST['surname'] : 'Лермонтов';
                $name = isset($_POST['name']) ? $_POST['name'] : 'Михаил';
                $patronym = isset($_POST['patronym']) ?  $_POST['patronym'] : 'Юрьевич';
                $person = "$surname $name $patronym";
                $personParts = getPartsFromFullname($person);
                echo "<p class='task__origin-user-name'>Пользователь: $person </p>"; 
            ?>
        </section>
        <section class='task'>
            <h3 class='task-header'>Половой состав</h3>
            <p><?php echo getGenderDescription($example_persons_array) ?></p>
        </section>
        <section class='task'>
            <h3 class='task__header'>Идеальный подбор пары</h3>
            <p class='task__compatible-container'><?php echo getPerfectPartner($personParts[0], $personParts[1], $personParts[2], $example_persons_array) ?></p>
        </section>
    </main>
</body>
<script src='../scriptes/index.js'></script>
</html>