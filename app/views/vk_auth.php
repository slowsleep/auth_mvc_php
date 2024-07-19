<?php
$state = randomString(32);
echo "<script>".
    "let state = '" . $state . "';".
    "</script>";
?>
<div id="VkIdSdkOneTap"></div>

<script>
    const VKID = window.VKIDSDK;

    VKID.Config.init({
        app: <?php echo '"'.CLIENT_ID.'"'; ?>, // Идентификатор приложения.
        redirectUrl: <?php echo '"'.REDIRECT_URL.'"'; ?>, // Адрес для перехода после авторизации.
        state: state, // Произвольная строка состояния приложения.
    });

    // Создание экземпляра кнопки.
    const oneTap = new VKID.OneTap();

    // Получение контейнера из разметки.
    const container = document.getElementById('VkIdSdkOneTap');

    // Проверка наличия кнопки в разметке.
    if (container) {
        // Отрисовка кнопки в контейнере с именем приложения APP_NAME, светлой темой и на русском языке.
        oneTap.render({
                container: container,
                scheme: VKID.Scheme.LIGHT,
                lang: VKID.Languages.RUS
            })
            .on(VKID.WidgetEvents.ERROR, handleError); // handleError — какой-либо обработчик ошибки.
    }

    function handleError(error) {
        console.log(error);
    }

</script>
