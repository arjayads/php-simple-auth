<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <h1>Reset password</h1>
                <form class="edit_member" id="edit_member" action="/password_reset.php" accept-charset="UTF-8" method="post">
                    <input type="hidden" name="member[email]" id="email" value="<?= $email ?>">
                    <input type="hidden" name="token" id="token" value="<?= $token ?>">
                    <?php if(isset($errors) && $errors) { ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach($errors as $err)  { ?>
                                    <li><?= $err ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="member_password">Password</label>
                        <input class="form-control" type="password" name="member[password]" id="member_password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmation</label>
                        <input class="form-control" type="password" name="member[password_confirmation]" id="member_password_confirmation">
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
                </form>      </div>
        </div>
    </div>
</div>