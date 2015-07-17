<div class="container">
    <?php if(isset($_SESSION['FLASH']['INFO'])) { ?>
        <div class="alert alert-info"><?= $_SESSION['FLASH']['INFO'] ?></div>
    <?php } ?>
    <h2>Welcome! <b><?= $name ?></b></h2>
</div>