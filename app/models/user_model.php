<?php

class User_Model extends Model
{
    /**
     * Получает незашифрованный пароль
     */
    public static function registration($login, $password)
    {
        try {
            $db = DB::connect();
            $sql = "INSERT INTO users (login, password) VALUES (:login, :password)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':login', $login);
            $hash_password = password_hash($password . SALT, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hash_password);
            $stmt->execute();

            if ($stmt) {
                return true;
            }
        } catch (PDOException $e) {
            error_log("Ошибка при добавлении пользователя");
            error_log($e->getMessage());
        }
        print_r($db->errorInfo());
        return false;
    }

    /**
     * Получает незашифрованный пароль
     */
    public static function login($login, $password)
    {
        try {
            $db = DB::connect();
            $query_user = "SELECT * FROM users WHERE login = :login";
            $stmt = $db->prepare($query_user);
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                if (password_verify($password . SALT, $user['password'])) {
                    $user = [
                        'id' => $user['id'],
                        'login' => $user['login'],
                        'role' => $user['role'],
                        'hash' => $user['hash'],
                    ];
                    return $user;
                }
            }
        } catch (PDOException $e) {
            error_log("Ошибка при входе (сверка логина и пароля)");
            error_log($e->getMessage());
        }
        global $logger;
        $logger->error("Пользователь не найден");
        return false;
    }

    public static function getUserByName($login)
    {
        try {
            $db = DB::connect();
            $sql = "SELECT * FROM users WHERE login = :login";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                $user = [
                    'id' => $user['id'],
                    'login' => $user['login'],
                    'role' => $user['role'],
                    'hash' => $user['hash'],
                ];
                return $user;
            }
        } catch (PDOException $e) {
            error_log("Пользователь не найден");
            error_log($e->getMessage());
        }
        return false;
    }

    public static function getUserByHash($hash)
    {
        try {
            $db = DB::connect();
            $sql = "SELECT * FROM users WHERE hash = :hash";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':hash', $hash);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                $user = [
                    'id' => $user['id'],
                    'login' => $user['login'],
                    'role' => $user['role'],
                    'hash' => $user['hash'],
                ];
                return $user;
            }
        } catch (PDOException $e) {
            error_log("Пользователь не найден");
            error_log($e->getMessage());
        }
        return false;
    }

    public static function setUserHash($id, $hash)
    {
        try {
            $db = DB::connect();
            $sql = "UPDATE users SET hash = :hash WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':hash', $hash);
            $stmt->execute();
            if ($stmt) {
                return true;
            }
        } catch (PDOException $e) {
            error_log("Пользователь не найден");
            error_log($e->getMessage());
        }
        return false;
    }
}
