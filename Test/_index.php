<div class="container">
    <?php if(isset($_SESSION['FLASH']['INFO']['success'])) { ?>
        <div class="alert alert-success"><?= $_SESSION['FLASH']['INFO']['success'] ?></div>
    <?php } else if(isset($_SESSION['FLASH']['INFO']['danger'])) { ?>
        <div class="alert alert-danger"><?= $_SESSION['FLASH']['INFO']['danger'] ?></div>
    <?php } else if(isset($_SESSION['FLASH']['INFO'])) { ?>
        <div class="alert alert-info"><?= $_SESSION['FLASH']['INFO'] ?></div>
    <?php } ?>
</div>

<header class="hero text-center">
    <div class="container">

        <div class="hero--info">
            <div class="hero-header">
                <h1 class="hero--info__header">Unified Customer Management</h1>
                <p class="lead">The real hero in CRM integration</p>
            </div>
            <ul class="list-inline">
                <li><a class="btn" href="/signup.php">Join now</a></li>
                <li><a class="btn btn-secondary" href="/session.php">Login</a></li>
            </ul>
        </div>
    </div>
</header>

<section id="block-services" class="block">
    <div class="block--services text-center container">
        <div class="text-center">
            <img src="assets/images/crm-strategy.png" alt="crm-strategy"  class="img-circle" />
        </div>
    </div>
</section>