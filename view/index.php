<?php
/**
 * @var $workers array
 * @var $currency string
 */
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Зарплаты</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/i18n/datepicker.ru-RU.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
</head>
<body>
<form action="" class="date-form">
    Выберите дату:
    <input type="text" name="date" id="date-select">
    <input type="submit" value="Показать">
</form>

<div>
    <a href="/?date=<?= $date ?>">Рубли</a>
    <a href="/?date=<?= $date ?>&currency=USD">Доллары</a>
</div>

<table class="salary-table">
    <thead>
    <tr>
        <td>ID</td>
        <td>Фамилия</td>
        <td>Имя</td>
        <td>Должность</td>
        <td>Зарплата</td>
        <td>Фото</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($workers as $worker): ?>
        <tr>
            <td><?= $worker->id ?></td>
            <td><?= $worker->lastname ?></td>
            <td><?= $worker->firstname ?></td>
            <td><?= $worker->profession->name ?></td>
            <td align="right"><?= $worker->getAdditionalSalary($currency) ?></td>
            <td>
                <?php if ($worker->photo): ?>
                    <img class="salary-img" src="<?= $worker->photo ?>" alt="">
                <?php else: ?>
                    <img class="salary-img" src="/img/no-image.png" alt="">
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div id="photo-review"></div>
<script src="/js/main.js"></script>
</body>
</html>