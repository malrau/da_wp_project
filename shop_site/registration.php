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
            /* Insert user data passed with the form into the userData table of 
               the comicsShopUsers database */
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $address = $_POST['address'];
            if ($_POST['userEmail'] === $_POST['confirmEmail']) {
                $userEmail = $_POST['userEmail'];
            } else {
                echo 'The email values do not match!';
            }
            $password = $_POST['password'];
            $sql = "INSERT INTO userData(firstName, lastName, address, email, pwd) VALUES('$firstName', '$lastName', '$address', '$userEmail', '$password')";
            if (mysqli_query($conn, $sql)) {
                /* retrieve the ID of the new user and insert it into the 
                   establishing table of the comicsShopUsers database */
                $date = date('Y-m-d');
                $sql2 = "SELECT U.userID from userData AS U WHERE U.email = '$userEmail'";
                $result = mysqli_query($conn, $sql2);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach ($row as $key => $value) {
                            $sql3 = "INSERT INTO establishing(aUser, aUserRole, dateRegistered) VALUES($value, 2, '$date')";
                            if (mysqli_query($conn, $sql3)) {
                                echo '<h3 class = \'simple_text\'>';
                                echo $firstName . ', ' . 'you successfully registered on ' . '<i>' . 'Comic books \'r us' . '</i>';
                                echo '</br>';
                                echo 'You can now ' . '<a href = \'register.html\'>' . 'login' . '</a>';
                                echo '</h3';
                            } else {
                                echo 'Registration failed. Check your data and ' . '<a href = \'register.html\'>' . 'try again' . '</a>';
                            }
                        }
                    }
                } else {
                    mysqli_error($conn);
                }
            } else {
                mysqli_error($conn);
            }
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
