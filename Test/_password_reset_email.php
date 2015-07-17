
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="row"><div class="col-md-12"><h1>Forgot password</h1></div></div>
                <form action="/password_reset.php" accept-charset="UTF-8" method="post">
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
                        <label for="email">Email</label>
                        <input class="form-control" placeholder="Enter email" type="email" name="password_reset[email]" id="password_reset_email">
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
                </form>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>
