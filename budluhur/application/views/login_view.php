<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <!-- Other CSS styles -->
    <style>
        /* Your custom CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <?php echo form_open('auth/login_process'); ?>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <?php echo form_input('username', '', 'id="username" class="form-control" required'); ?>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <?php echo form_password('password', '', 'id="password" class="form-control" required'); ?>
                            </div>
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div style="color: red;"><?php echo $this->session->flashdata('error'); ?></div>
                            <?php endif; ?>
                            <?php echo form_submit('submit', 'Login', 'class="btn btn-primary btn-block"'); ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and other scripts -->
    <script src="<?= base_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js') ?>"></script>
</body>
</html>
