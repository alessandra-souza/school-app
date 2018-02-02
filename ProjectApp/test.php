<!DOCTYPE html>
<html lang="en">
<head>
    <title>AJAX Pagination using PHP & MySQL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <style type="text/css">
    .panel-footer {
        padding: 0;
        background: none;
    }
    </style>

    
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootpag/1.0.7/jquery.bootpag.min.js"></script>
</head>
<body>

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

$stmt = $pdo->prepare("SELECT COUNT(*) FROM ipd11phpproject.students");
$stmt->execute();
$rows = $stmt->fetch();

// get total no. of pages
$total_pages = ceil($rows[0]/$row_limit);
?>

<br/>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3>jQuery PHP Pagination Demo</h3></div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                </tr>
            </thead>
            <tbody id="pg-results">
            </tbody>
        </table>
        <div class="panel-footer text-center">
            <div class="pagination"></div>
        </div>
    </div>
</div>
    


<!-- <script type="text/javascript">
$(document).ready(function() 
{
    $("#pg-results").load("pagination.php");
    $(".pagination").bootpag
    ({
        total: <?php echo $total_pages; ?>,
        page: 1,
        maxVisible: 5
    }).on("page", function(e, page_num)
    {
        e.preventDefault();
        $("#pg-results").load("pagination.php", {"page": page_num});
    });
});
</script> -->

<script type="text/javascript">
$(document).ready(function() 
{
    $("#pg-results").load("pagination.php");
    $(".pagination").bootpag
    ({
        total: <?php echo $total_pages; ?>,
        page: 1,
        maxVisible: 5
    }).on("page", function(e, page_num)
    {
        e.preventDefault();
        displayArray(response.data,page_num );
    });
});
</script>

</body>
</html>

