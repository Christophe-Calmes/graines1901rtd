<?php
if(isset($_SESSION['time'])&&($_SESSION['time'] < time())) {
  session_destroy();
    session_unset();
      header('location:index.php?message=Session expiré');
}