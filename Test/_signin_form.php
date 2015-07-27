<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="row"><div class="col-md-12"><h1>Sign-in using your account</h1></div></div>
                <?php include_once '_flasher.php'; ?>
                <form action="/session.php" method="post">
                    <?php if(isset($errors)) { ?>
                    <div class="alert alert-danger">
                        <ul>
                        <?php foreach($errors as $err)  { ?>
                            <li><?= $err ?></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="session[email]" value="<?= $session['email'] ?>" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>&nbsp;&nbsp; <a href="/password_reset.php">(forgot password)</a>
                        <input type="password" class="form-control" id="password" name="session[password]"  placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" <?= isset($session['remember_me']) && $session['remember_me'] == '1' ? 'checked' : '' ?> name="session[remember_me]" id="session_remember_me" value="1"><label style="margin-right: 20px; cursor: pointer" for="session_remember_me">&nbsp;&nbsp;Remember me on this computer</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="signin" value="signin" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>