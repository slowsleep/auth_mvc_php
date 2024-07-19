<?php
$auth = Auth::checkUserAuth();
if ($auth) {
    $user = $_SESSION['user'];
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/?page=main">Главная</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/?page=special">Специальная страница</a>
            </li>
        </ul>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <?php if ($auth) : ?>
                <p class="m-0 small">Привет, <?= (isset($user['login']) && $user['login']) ? $user['login'] : $user['first_name']; ?>!</p>
            <?php endif; ?>

            <ul class="navbar-nav">
                <?php if (!$auth) : ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/?page=registration">Зарегестрироваться</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=login">Войти</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=logout">Выйти</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
