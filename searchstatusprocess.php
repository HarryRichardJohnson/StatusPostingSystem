<DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>PHP</title>
  </head>
  <body>
    <h1>Status Posting System</h1>
    <?php
		require_once ("../../conf/settings.php");
    //creating connection
    $connection = new mysqli($host,$user,$pswd);
    $connection->select_db($dbnm);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $statusCode = $_GET["StatusCode"];
    //check if status code start with capital S
    if(substr($statusCode,0,1) == "S" ){
      //check if all characters after the S are numeric
      if (is_numeric(substr($statusCode,1))){
        //check if the numeric character after capital S is of string length 4
        if (strlen(substr($statusCode,1)) == "4"){
          $sql = ("SELECT statusID, status, share, allow_like, allow_comment, allow_share, statusdate FROM statusDB where statusID = '$statusCode';");

          $result = $connection->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

              echo "Status:" .$row["status"]. "<br/>";
              echo "Status Code: " . $row["statusID"]. "<br/><br/>";
              echo "Share: " . $row["share"]."<br/>";
              echo "Date Posted:". $row["statusdate"]."<br/>";
              echo "Permission:";
              if ($row["allow_like"]){
                echo "Like ";
              }
              if ($row["allow_comment"]){
                echo "Comment ";
              }
              if ($row["allow_share"]){
                echo "Share ";
              }
              if (!$row["allow_like"]&&!$row["allow_comment"]&&!$row["allow_share"]){
                echo "None";
              }
            }
          } else {
            echo "0 results";
          }
        }else{echo "<p>Invalid Status Code, must have a four number code</p>";}
      }else{echo "<p>Invalid Status Code, must have a four number code</p>";}
    }else{echo "<p>Invalid Status Code, status code must start with the capital letter 'S'</p>";}
  $connection->close();
  ?>
  <br/><br/>
  <a href="searchstatusform.php">Search for another status</a> <a href="index.php">Return to home page</a>
    </body>
  </html>
