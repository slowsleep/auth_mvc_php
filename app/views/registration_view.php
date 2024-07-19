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

<form class="mb-3" method="post" action="">
    <div class="mb-3">
        <label class="form-label">Логин</label>
        <input class="form-control" type="text" name="login" placeholder="Логин" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Пароль</label>
        <input class="form-control" type="password" name="pass" required>
    </div>
    <div>
        <input class="btn btn-success w-100" type="submit" value="Зарегистрироваться">
    </div>
</form>

<?php include "vk_auth.php"; ?>
