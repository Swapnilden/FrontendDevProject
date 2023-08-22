<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
  .special
  {
    display:flex;
    justify-content:center;
    align-items:center;
    
    
  }
  .Registration-Success
    {
      color:green;
      font-size:1.25rem;
      margin-top:0.5rem;
    }

    .registration-failed
     {
      color:red;
      font-size:1.25rem;
      margin-top:0.5rem;
     }  
    </style>
</head>
<body>
  
</body>
</html>
<?php
  $uname = $_POST['username'];
  $upass = $_POST['pass1'];
 
  $cypher_text=md5($upass);
 include_once "../shared/connection.php";
  $status=mysqli_query($conn,"insert into user2(username,password,usertype) values('$uname','$cypher_text','customer')");
    echo "<div class='special'>";
  if($status)
  {
    echo "<div class='Registration-Success'>Registration Success</div>";
  }
  else
  {
    echo "<div class='registration-failed>Registration Failed</div>";
    
  }
  echo "</div>";
  ?>