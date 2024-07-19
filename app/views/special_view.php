<?php if ($_SESSION["is_auth"]) : ?>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos vel ut deleniti aperiam a pariatur ad voluptatibus dicta, sunt excepturi architecto, similique quod tempora eius exercitationem ex cum odit explicabo?</p>
    <?php if ($_SESSION["user"]["role"] == 2) : ?>
        <img src="https://www.vetseti.ru/upload/resize_cache/iblock/b10/807_380_2619711fa078991f0a23d032687646b21/ff4m77pko7iey23gdw02ixvjkf8szp3d.jpg" />
    <?php endif; ?>
<?php else :
    header("Location: /");
endif; ?>
