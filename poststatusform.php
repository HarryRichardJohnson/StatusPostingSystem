<DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>PHP</title>
  </head>
  <body>

  <h1>Status Posting System</h1>
  <form action="poststatusprocess.php" method="post">
    Status Code (required):
    <input type="text" name="StatusCode" value="S">
    <br>
    Status (required):
    <input type="text" name="Status">
    <br><br>
      Share:
      <input type="radio" name="Share" checked value="Public"> Public
      <input type="radio" name="Share" value="Friends"> Friends
      <input type="radio" name="Share" value="OnlyMe"> Only Me
    <br>
    date   <input type="text" name="Date" value="<?php echo (Date('d/m/y'))?>">
    </br>
    Permission Type:
    <input type="checkbox" name="Permissionlike" value="AllowLike">
    Allow Like
    <input type="checkbox" name="Permissioncomment" value="AllowComment">
    Allow Comment
    <input type="checkbox" name="Permissionshare" value="AllowShare">
    Allow Share

  </br>
  </br>
  <input type="submit" value="Post">
</form>
<form action="poststatusform.php">
  <input type="submit" value="Reset">
</form>
<a href="index.php">Return to home page</a>
  </body>
</html>
