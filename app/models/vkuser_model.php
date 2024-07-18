<?php

class VKUser_Model extends Model
{
    public static function getUserById($id, $pathToFile = null) {
        try {
            $db = DB::connect($pathToFile ? $pathToFile : null);
            $query_user = "SELECT * FROM users WHERE vk_user_id = :vk_user_id";
            $stmt = $db->prepare($query_user);
            $stmt->bindParam(':vk_user_id', $id);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                return $user;
            }
        } catch (PDOException $e) {
            error_log("Пользователь не найден");
            error_log($e->getMessage());
        }
        return false;
    }

    public static function insertVKUser($vk_user_id, $vk_user_id_token, $pathToFile = null)
    {
        try {
            $db = DB::connect($pathToFile ? $pathToFile : null);
            $query_user = "INSERT INTO users (role, vk_user_id, vk_user_id_token) VALUES (2, :vk_user_id, :vk_user_id_token)";
            $stmt = $db->prepare($query_user);
            $stmt->bindParam(':vk_user_id', $vk_user_id);
            $stmt->bindParam(':vk_user_id_token', $vk_user_id_token);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Не удалось добавить пользователя");
            error_log($e->getMessage());
        }
        return false;
    }
}
