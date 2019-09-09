<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>
<form action="" method="post" class="new-worker-form" enctype="multipart/form-data">
    <p>Фамилия:</p><input type="text" name="lastname"><br>
    <p>Имя:</p><input type="text" name="firstname"><br>
    <p>Должность:</p> <?= \App\FormHelper::getDropdown(\App\Profession::class, 'position')?>
    <p>Зарплата:</p><input type="text" name="salary"><br>
    <p>Фото:</p><input type="file" name="photo"><br>
    <input type="submit" value="Создать">
</form>
</body>
</html>