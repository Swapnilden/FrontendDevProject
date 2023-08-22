<?php
 session_start();
 if(!isset($_SESSION['login_status']))
 {
     echo "Illegal Attempt";
      die;
 }
 if($_SESSION['login_status']==false)
 {
     echo "Login Failed; Illegal Attempt";
     die;
 }
 if($_SESSION['usertype']!='customer')
 {
   echo "Unautohrised User Type";
 }
  $userid=$_SESSION['userid'];
  $username=$_SESSION['username'];
  $usertype=$_SESSION['usertype'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Add some styles to improve the layout and appearance */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .auth-parent {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .auth-label {
            font-weight: bold;
            margin-right: 10px;
        }
        
        /* Add additional styles as needed */
    </style>
</head>
<body>

    <div class="container">
        <div class="auth-parent">
            <div>
                <span class="auth-label">User ID:</span>
                <?php echo $userid; ?>
            </div>
            <div>
                <span class="auth-label">Username:</span>
                <?php echo $username; ?>
            </div>
            <div>
                <span class="auth-label">User Type:</span>
                <?php echo $usertype; ?>
            </div>
        </div>
    </div>
</body>
</html>
