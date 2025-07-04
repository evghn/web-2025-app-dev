<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <?= $this->getLinkCssFiles() ?>
</head>

<body>
    Страница
    <div>
        <a href="/user/register">Регистрация</a>
    </div>
    <div>
        <?= $content ?>
    </div>
    <footer>
        footer
    </footer>
</body>

</html>