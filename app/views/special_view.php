<h1>Спецаильная страница только для авторизованных</h1>
<?php if ( isset($_SESSION["is_auth"]) && $_SESSION["is_auth"]) : ?>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos vel ut deleniti aperiam a pariatur ad voluptatibus dicta, sunt excepturi architecto, similique quod tempora eius exercitationem ex cum odit explicabo?</p>
    <?php if ($_SESSION["user"]["role"] == 2) : ?>
        <img src="/app/img/kitty.jpg" />
    <?php endif; ?>
<?php else :
    header("Location: /");
endif; ?>
