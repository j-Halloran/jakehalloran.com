<?php
  $host = $_SERVER['HTTP_HOST'];
  $table = 'FAVORITES_TABLE';
  $servername = 'localhost';
  $username = 'username';
  $password = 'password';
  $dbname = 'favorites1';
  $favorite = '';
  $category = '';


  foreach ($_POST as $k => $v) {
    $category = $k;
  }

  //Open and make sure the database exists (all of this is so it works when you test it)
  $conn = new mysqli($servername,$username,$password);
  $sql = 'CREATE DATABASE IF NOT EXISTS favorites1';
  if(!$conn->query($sql) === true){
    echo "Error creating database: ". $conn->error;
  }

  //reopen connection now that database is sure to exist
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  //check for the table, create it if necessary
  if(mysqli_num_rows($conn->query("SHOW TABLES LIKE '".$table."'"))<1){
    $sql = "CREATE TABLE favorites_table (
      category VARCHAR(100) PRIMARY KEY,
      favorite VARCHAR(1000) NOT NULL
    )";

    if (!$conn->query($sql) === TRUE) {
      echo "Error creating table: " . $conn->error;
    }

    //add data to table if the table didnt exist before
    $sql = "INSERT INTO `favorites_table` (`category`, `favorite`)
     VALUES ('book', '100 Years of Solitude'), ('console', 'Xbox One'),
     ('album','Bad Blood'), ('band','Vampire Weekend'), ('food','A Barbacoa Burrito'),
     ('movie','Saving Private Ryan'), ('place','Disney World'), ('politician','Bernie Sanders'),
     ('programming language','Python'), ('song','Sweet Disaster'),
     ('sport','football'), ('video game','Witcher III')";

     if(!$conn->query($sql) === TRUE){
       echo "Error Initializing Table Data: " . $conn->error;
     }
   }

  $sql = "SELECT category, favorite FROM FAVORITES_TABLE";
  $result = $conn->query($sql);

  if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()){
      if($row["category"]==$category){
        $favorite = "Jake's favorite ".$category." is ".$row['favorite']."!";
        break;
      }
    }
  }

  if($favorite == ''){
    $favorite = "Sorry, that category was not found, try album, food, band etc...";
  }

  echo $favorite;
?>
