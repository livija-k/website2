<?php 
include_once 'db.php';
include_once 'utils.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Check if username is empty
  if(empty(trim($_POST["username"]))){
    $username_err = 'Please enter username.';
  } else{
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if(empty($_POST['password'])){
    $password_err = 'Please enter your password.';
  } else{
    $password = $_POST['password'];
  }

  // Validate credentials
  if(empty($username_err) && empty($password_err)){
    $result = login($username, $password, NULL, $conn);
    
    if ($result == LoginResult::Ok)
    {
      /* Password is correct, so start a new session and
                            save the username to the session */
      session_start();
      $_SESSION = array();
      $_SESSION['username'] = $username;  
      $_SESSION['password'] = $hashed_password;
      header("location: index.php");
    }
    else if ($result == LoginResult::ErrorUsername)
    {
      // Display an error message if username doesn't exist
      $username_err = 'No account found with that username.';
    }
    else if ($result == LoginResult::ErrorPassword)
    {
      // Display an error message if password is not valid
      $password_err = 'The password you entered was not valid.';
    }
    else
    {
      $username_err = "Oops! Something went wrong. Please try again later.";
    }
  }
}
?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="<?php echo getValueOr($_SERVER["PHP_SELF"]); ?>" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <?php
        if (!empty($username_err))
        {
          echo '<div class="alert alert-danger" role="alert">
                  '.$username_err.'
                </div>';
        }
        if (!empty($password_err))
        {
          echo '<div class="alert alert-danger" role="alert">
                  '.$password_err.'
                </div>';
        }
      ?>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input name="username" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" value="<?php echo $username; ?>">
      <label for="inputPassword" class="sr-only">Password</label>
      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
  </body>
</html>
