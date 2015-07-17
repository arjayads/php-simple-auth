<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="row"><div class="col-md-12"><h1>Signup to join</h1></div></div>
                <form action="/signup.php" accept-charset="UTF-8" method="post">
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
                        <label for="first_name">First name </label>
                        <input type="text" class="form-control" id="first_name" name="member[first_name]" value="<?= $member['first_name'] ?>" placeholder="First name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="member[last_name]" value="<?= $member['last_name'] ?>" placeholder="Last name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="member[email]" value="<?= $member['email'] ?>" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="member[password]" value="" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="member[password_confirmation]" value="" placeholder="Confirm password">
                    </div>
                    <div class="text-center"><button type="submit" name="signup" class="btn btn-primary">Submit</button></div>
                </form>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>