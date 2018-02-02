<?php include __DIR__ . '/defines.php'; ?>
<html>
    <head>
        <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-flatly.min.css" />
        <link rel="stylesheet" href="/assets/css/style.css" />
        <title>IPD11 - PHP - Project</title>
    </head>
    <body>

        <script src="/assets/bootstrap/js/jquery-v3.2.1.min.js"></script>
        <script src="/assets/bootstrap/js/popper.min.js"></script>
        <script src="/assets/bootstrap/js/bootstrap-v4.0.0-beta.3.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
        <script src="/assets/js/handlebars-v4.0.11.js"></script>          
        <script src="/assets/js/jquery.form-validator.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        
        <?php include INCLUDES_DIR . '/header.php'; ?>
            <div class="container">
                <main role="main"><br>
                <?php include Lib\Request::contentFile(); ?>
                </main>
            </div>
                <?php include INCLUDES_DIR . '/footer.php';?>

      
    </body>
</html>