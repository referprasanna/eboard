<?php

    session_start();

    //Include session variables
    if (!isset($_SESSION['SESSION']))  {
  include ( "./libraries/session_init.php");
    }
    
    //If the user is already logged in, the page is redirected to 'home.php'
    if ($_SESSION['LOGGEDIN'] == true)  {
	header("Location: home.php");
	exit;
    }
	
    $username = "";
	
    if (isset($HTTP_GET_VARS["username"]))  {
	$username = $HTTP_GET_VARS["username"];
    }
	
    if ($username == '')  { 
	if (isset($_SESSION['USERNAME'])) 
	$username = $_SESSION['USERNAME'];
    }
	
    //Initialize error variables
    $error = "";
    $error_style1 = "";
    $error_style2 = "";
	
    $flg = $_SESSION['FLAG'];	
	
    //Displays error if any of the login fields are empty
    if ($flg == "red")  {
	$error = "<span style=\"font-face: arial; color: #C00; \">"."Please enter the following fields marked with *"."</span><br /><br />";
	$error_style1 = "<span style=\"font-face: arial; color: #C00;\">"; 
	$error_style2 = "*"."</span>";
    }
	
    //Display error if the username/password is not found in the database
    else if($flg == "orange")  {
	$error = "<span style=\"font-face: arial; color: #C00; \">"."Invalid username/password"."</span><br /><br />";
	$error_style1 = "<span style=\"font-face: arial; color: #C00;\">"; 
	$error_style2 = "</span>";
    }
			
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="description" content="Sign in and enjoy the virtual classroom">
    <title>Login</title>
	
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.17.custom.css"/>
    <link rel="stylesheet" type="text/css" href="css/button.css"/>
    
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
    <script type="text/javascript" src="js/validate.js"></script>
    
    <script type="text/javascript">
        //Toggle animation for registration panel
	$(document).ready(function()  {
            $(".panel_button").click(function()  {
                $(".panel").toggle("fast");
		$(this).toggleClass("active");
		return false;
            });
	});
    </script>

    <script type="text/javascript" >
        //Animation effect if focused on input fields in registration panel
	$(document).ready(function()  {
            $("input,textarea").focus(function ()  {
                $(this).next("span").show("slow").css("display","inline");
            });
        
            $("input,textarea").focusout(function ()  {
                $(this).next("span").hide("slow");
            });
		
            $("input,select").focus(function ()  {
                $(this).next("span").show("slow").css("display","inline");
            });
	
            $("input,select").focusout(function ()  {
                $(this).next("span").hide("slow");
            });
	});
    </script>
        
</head>

<body>
<div class="container">
    <div class="header-bar">
        <div class="header-text">
            <div align="center">Student Portal</div>
        </div>
    </div>
    	
    <div class="wrapper clearfix">
	<div class="sign-in">
            <div class="signin-box">
                <h2>SIGN IN</h2>
                <form  name="signin" action="./libraries/loggedin.php" id="loginform" method="post">
                    <label for="username" >
                        <span class="email-label">
                            <?php echo $error_style1; ?>Username<?php echo $error_style2;?>
                        </span>
                    </label>
                    <input name="username" id="username" type="text" />
                    
                    <br />
                    
                    <label for="password">
                        <span class="passwd-label">
                            <?php echo $error_style1; ?>Password <?php echo $error_style2;?>
                        </span>
                    </label>
                    <input name="password" id="Passwd" type="password" />
		
                    <br />
		
                    <input class="button" name="signIn" id="signIn" value="Sign in" style="margin-bottom: 15px;" type="submit" />
                </form>
                <!-- Displays the error field  -->
		<?php echo $error; ?>
            </div>  <!-- end signin-box -->
           </div>  <!-- end sign-in -->
    </div>  <!-- end wrapper clearfix -->
    
    <div class="panel">
        <form id="createaccount" name="createaccount" action="./libraries/reg_verify.php" onSubmit="return validate_form(); return false;" method="post" >
            <table class="register_table" border="0">
                <caption> REGISTER HERE </caption>

                <tr>
                    <th>
                        <label for="RegNumber">
                            <span id="RegNumberLabel">
                                Register Number  &nbsp; &#8250&#8250;
                            </span>
                        </label>
                    </th>
		
                    <td>
                        <input name="RegNumber" id="RegNumber" size="30" type="text" />
                            <span class="popup">
                                Enter your register number
                            </span>
                    </td>
                </tr>
            
                <tr>
                    <th>
                        <label for="Email">
                            <span id="EmailLabel">
                                E-Mail id &nbsp; &#8250&#8250;
                            </span>
                        </label>
                    </th>
                    
                    <td>
                        <input name="Email" id="Email" size="30" type="text">
                        <span class="popup">
                            Enter your E-mail
                        </span>
                    </td>
                </tr>
                    
                <tr>
                    <th>
                        <label for="Passwd" >
                            <span id="PasswdLabel">
                                Choose a password &nbsp; &#8250&#8250;
                            </span>
                        </label>
                    </th>
                    
                    <td>
                        <input name="PassCode" id="Passwd" size="30" type="password" />
                        <span class="popup">
                            Enter your password
                        </span>
                    </td>
                </tr>
                    
                <tr>
                    <th>
                        <label for="PasswdAgain" >
                            <span id="PasswdAgainLabel">
                                Re-enter password &nbsp; &#8250&#8250;
                            </span>
                        </label>
                    </th>
                    
                    <td>
                        <input name="PasswdAgain" id="PasswdAgain" size="30" type="password" />
                        <span class="popup">
                            Re-Enter your password
                        </span>  
                    </td>
                </tr>
                    
                <tr>
                    <th></th>
                    
                    <td>  
                        <input type="submit" id="submit" name="submit" value="Create account" class="button">  
                        <input type="reset" name="Reset" class="button">
                    </td>
            
                </tr>
            </table>
        </form>
        
    </div>  <!-- end panel -->
        
    <a class="panel_button" href="#">
        Register
    </a>  <!-- end panel_button -->
    
</div>  <!-- end container -->
</body>
</html>
