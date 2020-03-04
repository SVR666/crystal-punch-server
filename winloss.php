<?php
  if(isset($_POST['win_loss']))
  {
    $uid = $_POST['username'];
    include 'config.php';
    if ($_POST['win_loss'] == "loss")
    {
      $sql = "UPDATE winloss SET loss = loss+1 WHERE username = '$uid';";
      pg_query($conn, $sql);
      pg_close($conn);
    }
    elseif ($_POST['win_loss'] == "win")
    {
      $sql = "UPDATE winloss SET win = win+1 WHERE username = '$uid';";
      pg_query($conn, $sql);
      pg_close($conn);
    }
  }
 ?>
