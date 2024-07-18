<h1>Main</h1>
<p>Welcome!</p>

<?php if (Auth::checkUserAuth()): ?>
    <p>Hello, <?= isset($_SESSION["user"]["login"]) && $_SESSION["user"]["login"] ? $_SESSION["user"]["login"] : $_SESSION["user"]["first_name"] ?></p>
    <p>На эту кнопку может нажать только пользователь VK</p>
    <button id="clickme" <?php if ($_SESSION["user"]["role"] == 2): ?>disabled<?php endif; ?> >Нажми на меня!!!!</button>
<?php else: ?>
    <p>Hello, guest</p>
<?php endif; ?>

<?php
echo "<pre>";
print_r($_SESSION);
?>

<script>
    document.querySelector('#clickme').addEventListener('click', function () {
        alert('Hello VK user!');
    })
</script>
