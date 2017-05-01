<?php
  $host = $_SERVER['HTTP_HOST'];
  $table = 'contact_table';
  $servername = 'localhost';
  $username = 'findaseat';
  $password = 'findaseatroot';
  $dbname = 'contact_db';
  $email ='';
  $name = '';
  $comment ='';



  //Database stuff
  $conn = new mysqli($servername,$username,$password);
  $sql = 'CREATE DATABASE IF NOT EXISTS contact_db';
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
    $sql = "CREATE TABLE contact_table (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(100) NOT NULL,
      email VARCHAR(100) NOT NULL,
      comment VARCHAR(1000) NOT NULL
    )";

    if (!$conn->query($sql) === TRUE) {
      echo "Error creating table: " . $conn->error;
    }
  }
   
  //escape the data from the post
  foreach ($_POST as $k => $v) {
    if($k == "comment-field"){
      $comment = $v;// $conn->mysqli_real_escape_string($v);
    }
    elseif($k=="email-field"){
      $email = $v;//$conn->mysqli_real_escape_string($v);
    }
    elseif($k=="name-field"){
      $name = $v;//$conn->mysqli_real_escape_string($v);
    }
  }

  //backup data copy
  /*$comment = $_POST['comment-field];
  $email = $_POST['email-field'];
  $name = $_POST['name-field'];*/

  //store the data in the table
  $sql = "INSERT INTO contact_table (name,email,comment)
  VALUES ('$name','$email','$comment')";
  if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>
