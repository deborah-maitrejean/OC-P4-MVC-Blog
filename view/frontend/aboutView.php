<?php $title = 'Billet simple pour l\'Alaska'; ?>
<?php ob_start(); ?>

<div class="row" id="about-view">
    <div class="col-lg-12">
        <h2>Qui suis-je ?</h2>
        <div class="row">
            <div class="col-lg-6">
                <img src="<?= ASSETS ?>img/portrait-jean-forteroche.jpg" alt="Portrait noir et blanc de l'auteur Jean Forteroche." class="img-thumbnail img-responsive">
            </div>
            <div class="col-lg-6">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet mauris eget tortor tristique interdum. Morbi aliquam in
                    turpis at congue. Aenean pulvinar, eros eu efficitur iaculis, nunc sem tincidunt ante, ultrices aliquet enim urna at sem.
                    Pellentesque ut sagittis ligula. Morbi euismod, eros sit amet tincidunt imperdiet, dolor purus cursus velit, nec pretium nunc nulla a dui.
                </p>
                <p>
                    Quisque diam nisl, ornare at scelerisque nec, mattis vel sem. Pellentesque dui ante, suscipit a dignissim ut, dapibus sed libero.
                    Nam non elit nec massa pretium tristique non ac sapien. Sed quis purus id ex laoreet condimentum. Nulla posuere lobortis dolor, id
                    malesuada nisi pellentesque quis. Nam dictum mollis eros, a scelerisque ipsum faucibus nec. Vivamus massa nibh,
                    rutrum sed lobortis vel, cursus id nulla. Proin cursus luctus odio, eu finibus nisl fringilla id. Maecenas vel fringilla erat.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet mauris eget tortor tristique interdum. Morbi aliquam in turpis at congue.
                    Aenean pulvinar, eros eu efficitur iaculis, nunc sem tincidunt ante, ultrices aliquet enim urna at sem.
                    Pellentesque ut sagittis ligula. Morbi euismod, eros sit amet tincidunt imperdiet, dolor purus cursus velit, nec pretium nunc nulla a dui.
                </p>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
