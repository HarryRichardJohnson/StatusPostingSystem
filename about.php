<DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>PHP</title>
  </head>
  <body>
    <h1>Status Posting System</h1>
    <p>Name: Harry Johnson</p>
    <p>StudentID: YMH2207</p>
    <p>Email: ymh2207@aut.ac.nz</p>
    </br>
    <h2>Step 1</h2>
    <p>* I have created PHP code to determine if the entered status ID is unique
    and valid.<br/> * I had trouble with making the statement to check if the
    status ID was unique, this was a very difficult and time consuming endevour
    however I feel it taught me alot about PHP in my attempts.<br/>*next time
    I would like to spend more time understanding how SQL works as SQL statement
    have been a struggle in this assignment for me.* I used the PHP manuals
    available online to aid my understanding <a href="http://php.net/manual/en/i
    ndex.php">http://php.net/manual/en/index.php</a> <br/>* During this assignment i learnt
    alot about PHP and its built in functions: for example strlen(). <br/>
    * The date handling assumes will only allow status' to be uploaded if the date has at least
    one number less than 12 since there are only 12 months, the smallest number is used as the month
    the problem with this is that if the year is less than 12 (for example posted in 31/12/2009) the system would take 09
    as the month and if the month is 12 in this as the day, this means if the date was entered 31/12/09
  there would be no error even though that date doesnt exist. this could be fixed by adding more functionality but
  since 2009 is passed no one should be posting from 2009. a better option is for the server to assign dates without user input. </p>
    <a href="index.php">Return to home page</a>
  </body>
</html>
