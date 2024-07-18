<?php

require_once '../config/config.php';
require_once '../core/model.php';
require_once '../core/db.php';
require_once '../models/vkuser_model.php';

session_start();
$result = [];
$errors = [];

if (isset($_POST["user_id"]) && isset($_POST["id_token"]) && isset($_POST["access_token"]) &&
    isset($_POST["refresh_token"]) && isset($_POST["expires_in"]))
{
    // Проверить есть ли такой пользователь в бд, если нет, то записать и авторизовать
    $vk_user = VKUser_Model::getUserById($_POST["user_id"], "../db/db.sqlite");
    if (!$vk_user) {
        $new_vk_user = VKUser_Model::insertVKUser($_POST["user_id"], $_POST["id_token"], "../db/db.sqlite");
        if (!$new_vk_user) {
            $errors[] = "Не удалось записать пользователя в базу данных";
        } else {
            $result = [
                "status" => "success",
                "message" => "Пользователь успешно зарегистрирован"
            ];
        }
    } else {
        $result = [
            "status" => "success",
            "message" => "Авторизация прошла успешно"
        ];
    }

    if ($vk_user || $new_vk_user) {
        $_SESSION["is_auth"] = true;

        // Получить данные пользователя с помощью access_token
        $query = http_build_query([
            "client_id" => CLIENT_ID,
            "access_token" => $_POST["access_token"],
        ]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://id.vk.com/oauth2/user_info");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $_SESSION["user"] = $result["user"];
        $_SESSION["user"]["role"] = 2;
    }
} else {
    $errors[] = "Параметров user_id, id_token, access_token, refresh_token, expires_in нет";
}

if (!empty($errors)) {
    $result = [
        "status" => "error",
        "errors" => $errors
    ];
}

echo json_encode($result);
