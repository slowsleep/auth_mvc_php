<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@vkid/sdk@<3.0.0/dist-sdk/umd/index.js"></script>
    <title>Auth with VK</title>
</head>

<body>
    <header>
        <ul>
            <li>
                <a href="/?page=main">Главная</a>
            </li>
            <li>
                <a href="/?page=login">Войти</a>
            </li>
            <li>
                <a href="/?page=registration">Зарегистрироваться</a>
            </li>
            <li>
                <a href="/?page=logout">Выйти</a>
            </li>
        </ul>
    </header>
    <main>
        <?php include 'app/views/' . $content_view ?>
    </main>
</body>

</html>