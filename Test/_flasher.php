<?php

require_once '../Helper/Session.php';

if(Session::getFlash('danger')) { ?>
    <div class="alert alert-danger"><?= Session::getFlash('danger') ?></div>
<?php } else if(Session::getFlash('success')) { ?>
    <div class="alert alert-success"><?= Session::getFlash('success') ?></div>
<?php } else if(Session::getFlash('info')) { ?>
    <div class="alert alert-info"><?= Session::getFlash('info') ?></div>
<?php } else if(Session::getFlash() && is_array(Session::getFlash())) { ?>
    <div class="alert alert-info">
        <ul>
            <?php foreach(Session::getFlash() as $message) { ?>
                    <li><?= $message ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>