<!DOCTYPE html>
<html>
    
<!-- Mirrored from lambdathemes.in/admin2/login-alt.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Feb 2016 17:32:08 GMT -->
<head>
        
        <!-- Title -->
        <title>Modern | Login - Sign in</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url()?>/assets/admin/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="<?php echo base_url()?>/assets/admin/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url()?>/assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>/assets/admin/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>/assets/admin/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url()?>/assets/admin/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url()?>/assets/admin/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>/assets/admin/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        
        <!-- Theme Styles -->
        <link href="<?php echo base_url()?>/assets/admin/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>/assets/admin/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="<?php echo base_url()?>/assets/admin/plugins/3d-bold-navigation/js/modernizr.js"></script>
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="page-login login-alt">
        <main class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-6 center">
                            <div class="login-box panel panel-white">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="index-2.html" class="logo-name text-lg">Modern</a>
                                            <p class="m-t-md">The Modern UI Framework is a premium Web Application Admin Dashboard built on top of Twitter Bootstrap 3.3.4 Framework.<br> It was created to be the most functional, clean and well designed theme for any types of backend applications.We have carefully designed all common elements.</p>
                                            <div class="btn-group btn-group-justified m-t-sm" role="group" aria-label="Justified button group">
                                                <a href="#" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                                                <a href="#" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
                                                <a href="#" class="btn btn-google"><i class="fa fa-google-plus"></i> Google+</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo form_open('login/login')?>
                                                <?php if ($user_verified == 0){?>
                                                    <div class="form-group">
                                                        <input type="text" name="user" class="form-control" placeholder="Email" required>
                                                    </div>
                                                <?php } else if ($user_verified == 1){?>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Email or Username" value="<?php echo $username;?>" required disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control" placeholder="Password" required>
                                                    </div>
                                                <?php } ?>
                                                <button type="submit" class="btn btn-success btn-block">Login</button>
                                                <a href="forgot.html" class="display-block text-center m-t-md text-sm">Forgot Password?</a>
                                                <p class="text-center m-t-xs text-sm">Do not have an account?</p>
                                                <a href="register-alt.html" class="btn btn-default btn-block m-t-md">Create an account</a>
                                            <?php echo form_close()?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
	

        <!-- Javascripts -->
        <script src="<?php echo base_url()?>/assets/admin/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/plugins/pace-master/pace.min.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/plugins/classie/classie.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/plugins/waves/waves.min.js"></script>
        <script src="<?php echo base_url()?>/assets/admin/js/modern.min.js"></script>
        
    </body>

<!-- Mirrored from lambdathemes.in/admin2/login-alt.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Feb 2016 17:32:08 GMT -->
</html>