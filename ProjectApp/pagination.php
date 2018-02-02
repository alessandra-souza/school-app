<?php

//connect db
$hostname = "localhost";
$username = "test"; // change to yours
$password = "test"; // change to yours
$database = "ipd11phpproject";
$row_limit = 5;

// connect to mysql
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    die("Error! " . $err->getMessage());
}

//fetch data
if (isset($_POST["page"])) {
    $page_no = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if(!is_numeric($page_no))
        die("Error fetching data! Invalid page number!!!");
} else {
    $page_no = 1;
}

// get record starting position
$start = (($page_no-1) * $row_limit);

$results = $pdo->prepare("SELECT * FROM ipd11phpproject.students LIMIT $start, $row_limit");
$results->execute();

while($row = $results->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>" . 
    "<td>" . $row['first_name'] . "</td>" . 
    "<td>" . $row['last_name'] . "</td>" . 
    "<td>" . $row['dob'] . "</td>" . 
    "</tr>";
}
?>