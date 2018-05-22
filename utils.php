<?php
function getRowValue($row, $column) 
{
  return strip_tags($row[$column]);
}

function getRowValueOr($row, $column, $or = "") 
{
  if (isset($row[$column])) 
    return strip_tags($row[$column]);
  else 
    return $or;
}

function getValue($value) 
{
  return strip_tags($value);
}

function getValueOr($value, $or = "") 
{
  if (isset($value)) 
    return strip_tags($value);
  else
    return $or;
}

abstract class LoginResult
{
  const Ok = 0;
  const ErrorUnknown = 1;
  const ErrorUsername = 2;
  const ErrorPassword = 3;
}

function login($username, $password, $hashed_password, $conn)
{
  // Prepare a select statement
  $sql = "SELECT username, password FROM users WHERE username = ?";

  if($stmt = $conn->prepare($sql))
  {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $param_username);

    // Set parameters
    $param_username = $username;

    // Attempt to execute the prepared statement
    if($stmt->execute())
    {
      // Store result
      $stmt->store_result();

      // Check if username exists, if yes then verify password
      if($stmt->num_rows == 1)
      {                    
        // Bind result variables
        $stmt->bind_result($username, $db_password);
        
        if($stmt->fetch())
        {
          if ((isset($password) && password_verify($password, $db_password))
            || (isset($hashed_password) && strcmp($db_password, $hashed_password) == 0))
          {              
            $stmt->close();
            return LoginResult::Ok;
          } 
          else
          {
            $stmt->close();
            return LoginResult::ErrorPassword;
          }
        }
      } 
      else
      {
        $stmt->close();
        return LoginResult::ErrorUsername;
      }
    }
  }

  // Close statement
  $stmt->close();
  return LoginResult::ErrorUnknown;
}

function validateSession($conn)
{
  if (session_status() == PHP_SESSION_NONE)
    return;
  
  $result = login($_SESSION['username'], NULL, $_SESSION['password'], $conn);
  
  if ($result != LoginResult::Ok)
  {
    session_destroy();
    $_SESSION = array();
  }
}

function getCurrentUsername($conn)
{
  validateSession($conn);
  
  if (session_status() == PHP_SESSION_NONE)
    return NULL;
  
  return isset($_SESSION) ? $_SESSION['username'] : "";
}
?>