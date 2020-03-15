<?php
  if(isset($_POST['win_loss']))
  {
    $uid = $_POST['uid'];
    $coin = $_POST['coin_count'];
    include 'config.php';
    if ($_POST['win_loss'] == "loss")
    {
      $sqll = "UPDATE winloss SET loss = loss+1, coins =coins+'$coin' WHERE username = '$uid';";
      pg_query($conn, $sqll);
      pg_close($conn);
    }
    elseif ($_POST['win_loss'] == "win")
    {
      $sqlw = "UPDATE winloss SET win = win+1 WHERE username = '$uid';";
      pg_query($conn, $sqlw);
      pg_close($conn);
    }
  }
 ?>
