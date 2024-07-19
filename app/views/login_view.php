<?php

if (!isset($_SESSION["CSRF"])) {
    $_SESSION["CSRF"] = hash('gost-crypto', random_int(0, 999999));
}

if (isset($_POST["login"]) && isset($_POST["pass"])) {
    if ($_POST["token"] == $_SESSION["CSRF"]) {
        $user = User_Model::login($_POST["login"], $_POST["pass"]);
        if ($user) {
            if (isset($_POST["remember"])) {
                setcookie("remember_me", true, time() + 3600 * 24 * 30);

                if ($user["hash"]) {
                    setcookie("hash", $user["hash"], time() + 3600 * 24 * 30);
                } else {
                    $remember_token = bin2hex(random_bytes(32));
                    $hashed_token = hash('sha256', $remember_token);

                    if (User_Model::setUserHash($user["id"], $hashed_token)) {
                        setcookie("hash", $hashed_token, time() + 3600 * 24 * 30);
                        $_SESSION["is_auth"] = true;
                        header("Location: /");
                    } else {
                        setcookie("hash", "", time() - 3600 * 24 * 30);
                        setcookie("remember_me", "", time() - 3600 * 24 * 30);
                        $_SESSION["is_auth"] = false;
                        echo "не удалось записать хэш";
                        exit();
                    }
                }
            }
            $_SESSION["is_auth"] = true;
            $_SESSION["user"] = $user;
            header("Location: /");
        } else {
            $_SESSION["is_auth"] = false;
            echo "Неправильный логин или пароль";
        }
    } else {
        echo "Плохой токен";
    }
    // Перегенерируем токен в любом случае
    $_SESSION["CSRF"] = hash('gost-crypto', random_int(0, 999999));
}
?>

<h1>Вход</h1>

<form method="post" action="">
    <input type="text" name="login" placeholder="Логин" required><br />
    <input type="password" name="pass" required> <br />
    <input type="hidden" name="token" value="<?= $_SESSION['CSRF'] ?>">
    <input type="checkbox" name="remember" value="1">Запомнить меня<br />
    <input type="submit" value="Войти">
</form>
<?php include "vk_auth.php"; ?>
