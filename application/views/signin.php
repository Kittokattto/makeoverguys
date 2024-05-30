<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>User Signin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #fff;
            background: #63738a;
            font-family: 'Roboto', sans-serif;
        }

        .form-control {
            height: 40px;
            box-shadow: none;
            color: #969fa4;
        }

        .form-control:focus {
            border-color: #5cb85c;
        }

        .form-control,
        .btn {
            border-radius: 3px;
        }

        .signup-form {
            width: 450px;
            margin: 0 auto;
            padding: 30px 0;
            font-size: 15px;
        }

        .signup-form h2 {
            color: #fff;
            margin: 0 0 15px;
            position: relative;
            text-align: center;
        }

        .signup-form h2:before,
        .signup-form h2:after {
            content: "";
            height: 2px;
            width: 30%;
            background: #d4d4d4;
            position: absolute;
            top: 50%;
            z-index: 2;
        }

        .signup-form h2:before {
            left: 0;
        }

        .signup-form h2:after {
            right: 0;
        }

        .signup-form .hint-text {
            color: #fff;
            margin-bottom: 30px;
            text-align: center;
        }

        .signup-form form {
            color: #999;
            border-radius: 3px;
            margin-bottom: 15px;
            background: #f2f3f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .signup-form .form-group {
            margin-bottom: 20px;
        }

        .signup-form input[type="checkbox"] {
            margin-top: 3px;
        }

        .signup-form .btn {
            font-size: 16px;
            font-weight: bold;
            min-width: 140px;
            outline: none !important;
        }

        .signup-form .row div:first-child {
            padding-right: 10px;
        }

        .signup-form .row div:last-child {
            padding-left: 10px;
        }

        .signup-form a {
            color: #fff;
            text-decoration: underline;
        }

        .signup-form a:hover {
            text-decoration: none;
        }

        .signup-form form a {
            color: #5cb85c;
            text-decoration: none;
        }

        .signup-form form a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="signup-form">
        <h2>Login</h2>
        <p class="hint-text">Sign in to start your session</p>

        <form id="loginForm">
            <div class="form-group">
                			<!--error message -->
			<?php if ($this->session->flashdata('error')) { ?>
				<p style="color:red"><?php echo $this->session->flashdata('error'); ?></p>
			<?php } ?>

			<!--success message -->
			<?php if ($this->session->flashdata('success')) { ?>
				<p style="color:green"><?php echo $this->session->flashdata('success'); ?></p>
			<?php } ?>
			
                <input type="text" name="emailid" id="emailid" class="form-control" placeholder="Enter your Email">
                <div id="emailid_error" style="color:red;"></div>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                <div id="password_error" style="color:red;"></div>
            </div>
            <div class="form-group">
                <input type="submit" name="insert" value="Submit" class="btn btn-success btn-lg btn-block">
            </div>

			<div class="form-group">
            <div style="display: flex; align-items: center;">
                <a href="<?php echo site_url('ForgotPassword'); ?>" title="Forgot Password?" style="color:#495057; margin-left: 10px;">
                    Forgot Password
                    <i class="fas fa-question-circle"></i>
                </a>
            </div>
        </div>
        </form>



        <div class="text-center">Not Registered Yet? <a href="<?php echo site_url('Signup'); ?>">Sign up here</a></div>
    </div>

    <script>
        $(document).ready(function () {
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo site_url("SignInController/login"); ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 'error') {
                            if (response.errors) {
                                $('#emailid_error').html(response.errors.emailid);
                                $('#password_error').html(response.errors.password);
                            } else {
                                $('#error_message').html(response.message);
                            }
                        } else {
							window.location.href = '<?php echo site_url("welcome"); ?>';
                            
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
