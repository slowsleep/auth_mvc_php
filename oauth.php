<?php

include 'app/config/config.php';
include 'app/helpers/randomString.php';

session_start();

if (isset($_GET["code"]) && isset($_GET["state"]) && isset($_GET["device_id"])) {

    $code = $_GET["code"];
    $state = $_GET["state"];
    $device_id = $_GET["device_id"];

    echo "<script>let code = '" . $code . "'; let state = '" . $state . "'; let device_id = '" . $device_id . "';</script>";
} else {

    echo "Параметров code, state, device_id нет<br>";
    echo "<a href='/'>На главную</a><br>";
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
}
?>
<script src="https://unpkg.com/@vkid/sdk@<3.0.0/dist-sdk/umd/index.js"></script>
<script>
    const VKID = window.VKIDSDK;
    VKID.Config.init({
        app: <?php echo '"' . CLIENT_ID . '"'; ?>, // Идентификатор приложения.
        redirectUrl: <?php echo '"' . REDIRECT_URL . '"'; ?>, // Адрес для перехода после авторизации.
        state: <?php echo '"' . randomString(32) . '"'; ?>, // Произвольная строка состояния приложения.
    });

    if (code && state && device_id) {
        let token = VKID.Auth.exchangeCode(code, device_id);
        token.then(function(token) {
            let tokenResult = token;
            let access_token = tokenResult.access_token;
            let expires_in = tokenResult.expires_in;
            let id_token = tokenResult.id_token;
            let refresh_token = tokenResult.refresh_token;
            let scope = tokenResult.scope;
            let state = tokenResult.state;
            let token_type = tokenResult.token_type;
            let user_id = tokenResult.user_id;

            // Делаем запрос в php handler с полученными данными
            let formData = new FormData();
            formData.append("user_id", user_id);
            formData.append("id_token", id_token);
            formData.append("access_token", access_token);
            formData.append("refresh_token", refresh_token);
            formData.append("expires_in", expires_in);

            fetch("app/handlers/auth_via_vk.php", {
                method: "POST",
                body: formData
            }).then(function(response) {
                return response.json();
            }).then(function(result) {
                if (result.status === "success") {
                    console.log(result.message);
                } else {
                    console.log(result.errors);
                }
                window.location.href = "/";
            });
        }).catch(function(error) {
            console.log(error);
            window.location.href = "/";
        });
    }
</script>