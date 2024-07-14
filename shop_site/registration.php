<!DOCTYPE html>
<html>

    <head>
        <title>Comic books'r us</title>
        <meta charset="UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = 'stylesheet' href = 'shopStyle.css' />
        <link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
    </head>

    <body id = 'registration'>
        <header>
            <div id = 'left'>
                <h1><a href = 'index.php'>Comic books'r us</a></h1>
                <h3>
                    The best place to buy comic books from the top comic book
                    publishers such as American Marvel and DC Comics or Italian Sergio 
                    Bonelli Editore.
                </h3>
            </div>
            <div id = 'right'>
                <img src = 'images/superciuk.gif' class = 'header_img' />
                <img src = 'images/larsen.png' class = 'header_img' />
                <img src = 'images/tdkr.jpg' class = 'header_img' />
                <img src = 'images/zagor.png' class = 'header_img' />
            </div>
        </header>
        <nav class = 'bg-light'>
            <h4>Select a publisher to see a list of comic books</h4>
            <ul>
                <li class = 'homelist'>
                    <a href = 'marvel/marvel.php' id = 'marvel_page'><img src = 'images/Marvel-Comics-Logo.png' title = 'Marvel Comics' height = '60' /></a>
                </li>
                <li class = 'homelist'>
                    <a href = 'dc/dc.php' id = 'dc_page'><img src = 'images/DC-comics-logo.png' title = 'DC Comics' height = '80' /></a>
                </li>
                <li class = 'homelist'>
                    <a href = 'bonelli/bonelli.php' id = 'bonelli_page'><img src = 'images/bonelli-logo.png' title = 'Sergio Bonelli Editore' height = '60' /></a>
                </li>
            </ul>
            <p>
                <a href = '/register.html' class = 'back_home_button btn btn-outline-primary'>Register / Login</a>
            </p>
        </nav>
        <?php
            include('connect_reg.php');
            /* Insert user data passed with the form into the comicsShopUsers database */
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $address = $_POST['address'];
            if ($_POST['userEmail'] === $_POST['confirmEmail']) {
                $userEmail = $_POST['userEmail'];
            } else {
                echo 'The email values do not match!';
            }
            $password = $_POST['password'];
            $date = date('Y-m-d');

            $sql = "INSERT INTO userData(firstName, lastName, address, email, pwd, lastLogin) VALUES('$firstName', '$lastName', '$address', '$userEmail', '$password', '$date')";
            if (mysqli_query($conn, $sql)) {
                echo '<h3 class = \'simple_text\'>';
                echo $firstName . ', ' . 'you successfully registered on ' . '<i>' . 'Comic books \'r us' . '</i>';
                echo '</br>';
                echo 'You can now ' . '<a href = \'register.html\'>' . 'login' . '</a>';
                echo '</h3';
            } else {
                echo 'Registration failed. Check your data and ' . '<a href = \'register.html\'>' . 'try again' . '</a>';
            }
            /*
            $sql = "SELECT R.publisherName, S.seriesName, C.cbID, C.datePublished, C.issueNumber, C.coverTitle, C.price, C.coverFolder, I.count FROM series AS S, comicBook AS C, belonging AS B, publisher AS R, publishing AS P, innerQuery AS I WHERE C.cbID = B.comicBook AND S.seriesName = B.series AND S.seriesName = P.series AND P.publisher = R.publisherName AND C.cbID = I.cbID ORDER BY I.count DESC;";
            $createView = mysqli_query($conn, $sqlView);
            $result = mysqli_query($conn, $sql);
            
            $bestSellers = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $bestSellers[] = $row;
            }*/
        ?>
        </section>
        <footer title = 'contactus'>
            <h3>For any info:</h3>
            <a href = 'contact_us.html'>Contact us</a>
            <br/>
            <h4 align = 'center'>Comic books'r us SRL</h4>
            <h4 align = 'center'>P.zza Pugliatti 1, 98122 Messina</h4>
            <h4 align = 'center'><a href = 'mailto:comicsrus@email.comics'>email: comicsrus@email.comics</a></h4>
            <h5 align = 'left'>All images used in this website are copyrights &#169; of the respective publisher.</h5>
        </footer>
    </body>

</html>
