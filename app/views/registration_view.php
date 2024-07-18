<?php

if (isset($_POST["login"]) && isset($_POST["pass"]))
{
    $anotherUser = User_Model::getUserByName($_POST["login"]);
    if ($anotherUser) {
        echo "Пользователь с таким именем уже существует";
        exit();
    }

    $addUser = User_Model::registration($_POST["login"], $_POST["pass"]);

    if ($addUser) {
        echo "Регистрация прошла успешно";
    } else {
        echo "Не удалось зарегистрироватся";
    }
}

?>

<h1>Регистрация</h1>

<form method="post" action="">
    <input type="text" name="login" placeholder="Логин"><br />
    <input type="password" name="pass"> <br />
    <input type="submit" value="Зарегистрироваться">
</form>
