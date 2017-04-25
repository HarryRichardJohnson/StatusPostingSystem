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

    function validDayForMonth($month, $day1, $day2){
      $result = false;
      if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
        if($day1 < 32 || $day2 < 32){
          $result = true;
        }
      }elseif($month == 4 || $month == 6 || $month == 9 || $month == 11){
            if($day1 < 31 || $day2 < 31){
              $result = true;
        }
      }else{
          if($day1 < 29 || $day2 < 29){
            $result = true;
          }
        }
      return $result;
      }

    function validDateForStrLen8($date){
      //12/45/78
      $result = false;
      $substr1 = substr($date,0,2);
      $substr2 = substr($date,3,2);
      $substr3 = substr($date,6,2);
      //if all three substrings are numeric
        if (is_numeric($substr1)){
          if(is_numeric($substr2)){
            if(is_numeric($substr3)){
              //check if one is able to be a month
              if($substr1<13||$substr2<13||$substr3<13){
                if($substr1  < $substr2){
                  if($substr1 < $substr3){
                    //substr1 is smallest and therefor will be month
                    $result = validDayForMonth($substr1,$substr2,$substr3);
                  }else{
                    //substr3 is smallest and therefor will be month
                    $result = validDayForMonth($substr3,$substr2,$substr1);
                  }
                }elseif ($substr2 < $substr3){
                    //substr2 is smallesr and therefor will be month
                    $result = validDayForMonth($substr2,$substr1,$substr3);
                  }else{
                    //substr3 is smallest and therefor will be month

                    $result = validDayForMonth($substr3,$substr2,$substr1);
                  }
                }

              }else{echo"<p>Month is not valid<p/>";}
            }else{echo"<p>Date is not valid</p>";}
          }else{echo"<p>Date is not valid</p>";}
        //}else{echo"<p>Date is not valid</p>";}
        return $result;
    }
		require_once ("../../conf/settings.php");
    //creating connection
    $connection = new mysqli($host,$user,$pswd);
    $connection->select_db($dbnm);
    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    //sql query to test if table exists
    $test = "select 1 from 'statusDB' LIMIT 1;";

    $test_table = $connection->query($test);
    //if table doesnt exist, create it
    if($test_table == FALSE)
    {
      //make table this is SQL code
      $createtable = "CREATE TABLE statusDB (
        statusID CHAR(5) NOT NULL,
        status TEXT NOT NULL,
        share VARCHAR(7) NOT NULL,
        allow_like BOOLEAN NOT NULL,
        allow_comment BOOLEAN NOT NULL,
        allow_share BOOLEAN NOT NULL,
        statusdate VARCHAR(8) NOT NULL);";
      //send query to database
      $connection->query($createtable);
    }

        if(!empty($_POST[Permissionlike])){
          $allowLike = '1';
        }else{
          $allowLike = '0';
        }
            if(!empty($_POST[Permissioncomment])){
              $allowComment = '1';
            }else{
              $allowComment = '0';
            }
                if(!empty($_POST[Permissionshare])){
                  $allowShare = '1';
                }else{
                $allowShare = '0';
              }

$statusCode = $_POST[StatusCode];
//check if status code start with capital S
  if(substr($_POST[StatusCode],0,1) == "S" ){
    //check if all characters after the S are numeric
    if (is_numeric(substr($_POST[StatusCode],1))){
      //check if the numeric character after capital S is of string length 4
      if (strlen(substr($_POST[StatusCode],1)) == "4"){
        //check that the Status is not an empty string
        if (!empty($_POST[Status])){
          $result = $connection->query("SELECT statusID FROM statusDB WHERE statusID = '$statusCode'");
          if($result->num_rows == 0) {
            if(validDateForStrLen8($_POST[Date])){
              //prepare insert statement - this is SQL code
              $insert = "Insert INTO statusDB(statusID,status,share,allow_like,allow_comment,allow_share,statusdate)".
              "VALUES ('".$_POST[StatusCode]."','".$_POST[Status]."','".$_POST[Share]."','".$allowLike."','".$allowComment."','"
              .$allowShare."','".$_POST[Date]."');";

              echo "<p>Post submitted successfully to Database</p>";

            }else{echo "<p>This is not a valid date<p/>";}
          }else{echo "<p>Status code is not unique<p/>";}
          //sent insert statement to database
          $connection->query($insert);
      }else{echo "<p>Invalid Status, Status cannot be null</p>";}
    }else{echo "<p>Invalid Status Code, must have a four number code</p>";}
  }else{echo "<p>Invalid Status Code, must have a four number code</p>";}
}else{echo "<p>Invalid Status Code, status code must start with the capital letter 'S'</p>";}
//}else{echo "<p>Invalid Status Code, this code is not unique</p>";}
    $connection->close();
?>
    <br/>
    <a href="index.php">Return to home page</a>
  </body>
</html>
