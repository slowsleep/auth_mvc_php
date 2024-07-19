<h1>Main</h1>
<p>Welcome!</p>

<?php if (Auth::checkUserAuth()): ?>
    <p>Hello, <?= isset($_SESSION["user"]["login"]) && $_SESSION["user"]["login"] ? $_SESSION["user"]["login"] : $_SESSION["user"]["first_name"] ?>!</p>
<?php else: ?>
    <p>Hello, guest</p>
<?php endif; ?>

<p>Здесь вы можете зарегистрироваться и войти через бд или через vk.</p>