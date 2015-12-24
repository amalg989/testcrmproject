<!DOCTYPE html>
<html>
    <head>
        <title>Test CRM Project</title>
                
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('/media/css/animate.css') }}"  />
        <link rel="stylesheet" type="text/css" href="{{ asset('/media/css/system.css') }}"  />
    </head>
    <body class="main">
        <div class="fluid-container">
            <div class="welcome-section col-md-8">
                <h1>Test CRM Project</h1>
                <div class="infoImg"></div>
            </div>
            <div class="login-section col-md-4">
                <section class="login">
                    <form action="/login" method="post">
                        <h3>Log In</h3>
                        <p>Enter your username and password to log in to your account.</p>
                        @if (isset($_GET['login']))
                            <div class="alert alert-danger">
                                <b>Invalid Username or Password. Please try again.</b>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="login_email">Email address</label>
                            <input type="email" class="form-control" id="login_email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="login_password">Password</label>
                            <input type="password" class="form-control" id="login_password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-default">Log In</button>
                        <div class="row">
                            <span>Not a member? <a href="javascript:void(0)" class="not-member" id="register-link">Click to register.</a></span>
                        </div>
                    </form>
                </section>
                <section class="registration">
                    <form action="/register" method="post">
                        <h3>Register</h3>
                        <p>Fill below fields and submit to register.</p>
                        <div class="form-group">
                            <label for="reg_fullname">Full Name</label>
                            <input type="text" class="form-control" id="reg_fullname" name="fullname" placeholder="Full Name" required>
                        </div><div class="form-group">
                            <label for="reg_email">Email address</label>
                            <input type="email" class="form-control" id="reg_email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" id="reg_password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input type="password" class="form-control" id="reg_confirmpassword" name="confirmpassword" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-default">Register</button>
                        <div class="row">
                            <span>Already a member? <a href="javascript:void(0)" class="member" id="login-link">Click to login.</a></span>
                        </div>
                    </form>
                </section>
                <footer>
                    &copy; 2015. Designed by <a href="">Amal Gamage</a>. 
                </footer>
            </div>
        </div>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="{{ asset('/media/js/base.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/media/js/base.js')}}" type="text/javascript"></script>
    </body>
</html>
