<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Page not Found - App</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 30px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .login-form .hint-text {
		color: #777;
		padding-bottom: 15px;
		text-align: center;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .login-btn {        
        font-size: 15px;
        font-weight: bold;
    }
    .or-seperator {
        margin: 20px 0 10px;
        text-align: center;
        border-top: 1px solid #ccc;
    }
    .or-seperator i {
        padding: 0 10px;
        background: #f7f7f7;
        position: relative;
        top: -11px;
        z-index: 1;
    }
    .social-btn .btn {
        margin: 10px 0;
        font-size: 15px;
        text-align: left; 
        line-height: 24px;       
    }
	.social-btn .btn i {
		float: left;
		margin: 4px 15px  0 5px;
        min-width: 15px;
	}
	.input-group-addon .fa{
		font-size: 18px;
	}
</style>
</head>
<body>
<div class="login-form">
<?php
$this->load->view('modules/notice');
?>
    <form action="" method="post">
        <h2 class="text-center">Access Denied</h2>		
        <img class="img-responsive" src="<?=base_url('assets/images/404.png')?>" >    
    </form>
    <div class="hint-text small">Login your account? <a href="<?=base_url('signup')?>" class="text-success">Login Now!</a></div>
</div>
</body>
</html>                            
