<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <h2>Register</h2>
        <p class="hint-text">Create your account. It's free and only takes a minute.</p>

        <form id="registrationForm" method="post" action="<?php echo site_url('SignUpController/register'); ?>">
            <div class="form-group">

				<!--error message -->
				<?php if ($this->session->flashdata('error')) { ?>
					<p style="color:red"><?php echo $this->session->flashdata('error'); ?></p>
				<?php } ?>

				<!--success message -->
				<?php if ($this->session->flashdata('success')) { ?>
					<p style="color:green"><?php echo $this->session->flashdata('success'); ?></p>
				<?php } ?>

                <div class="form-group">
                    <input type="text" name="username" class="form-control" value="" placeholder="Enter Username">
                    <div id="usernameError" style="color:red"></div>
                </div>
            </div>

            <div class="form-group">
                <input type="email" name="emailid" class="form-control" value="" placeholder="Enter your Email">
                <div id="emailError" style="color:red"></div>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" value="" placeholder="Password">
                <div id="passwordError" style="color:red"></div>
            </div>
            <div class="form-group">
                <input type="password" name="confirmpassword" class="form-control" value="" placeholder="Re-enter Password">
                <div id="confirmPasswordError" style="color:red"></div>
            </div>

            <div class="form-group">
                <button type="button" id="submitBtn" class="btn btn-success btn-lg btn-block">Submit</button>
            </div>
        </form>
        <div class="text-center">Already have an account? <a href="<?php echo site_url('Signin'); ?>">Sign in</a></div>
    </div>

    <script>
        $(document).ready(function() {
            $("#submitBtn").click(function() {
                var form_data = {
                    username: $('input[name="username"]').val(),
                    emailid: $('input[name="emailid"]').val(),
                    password: $('input[name="password"]').val(),
                    confirmpassword: $('input[name="confirmpassword"]').val()
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('SignUpController/register'); ?>",
                    data: form_data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') {
							window.location.href = '<?php echo site_url("Signin"); ?>';
                            $('#errorMessage').hide();
                        } else {
                            $('#errorMessage').html(response.message).show();
                            $('#successMessage').hide();
                        }

                        // Clear previous error messages
                        $('#usernameError').html('');
                        $('#emailError').html('');
                        $('#passwordError').html('');
                        $('#confirmPasswordError').html('');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
