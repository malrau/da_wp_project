<?php
    $expiryTime = time() + (60 * 60 * 3); // set expiry time within three hours
    $cookieKey = 'username';
    $cookieVal = $_POST['userName'];
    setcookie($cookieKey, $cookieVal, $expiryTime);
?>

<html>

    <head>
        <title>Comic books'r us login</title>
        <meta charset="UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = 'stylesheet' href = 'shopStyle.css' />
        <link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
        <script type = 'text/javascript' src = '/buildBestSellerSmallCard.js'></script>
        <!script type = 'text/javascript' src = 'shopScript.js'/script-->
    </head>
    <body>
        <?php
            $userFirstName = $_POST['userFirstName'];
            echo '<section>';
            echo '<h3 class = \'simple_text\'>';
            echo 'Welcome back to ' . '<i>' . 'Comic books \'r us' . '</i>' . ', ' . $userFirstName;
            echo '</br>';
            echo '</br>';
            echo '<a href = \'/index.php\' class = \'back_home_button btn btn-primary\'>';
            echo 'Got back to the home page and start buying';
            echo '</a>';
            echo '</section>';
        ?>
    </body>

</html>