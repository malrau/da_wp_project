<!DOCTYPE html>
<html>
    <head>
        <?php
        echo "<a href '../'></a>";
        $series = $_GET['series'];
        $title = $_GET['coverTitle'];
        echo "<title>" . 'Buy ' . $series . ' - ' . $title . "</title>";
        ?>
        <meta charset="UTF-8">
        <link rel = 'stylesheet' href = '/shopStyle.css' />
        <link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
	<script type = 'text/javascript' src = '/buildComicBookCard.js' /></script>
    </head>
    <body>
        <header>
            <div id = 'left'>
                <h1><a href = 'index.php'>Comic books'r us</a></h1>
                <h3>
                    The best place to buy comic books from the top comic book
                    publishers such as American Marvel and DC Comics or Italian Sergio 
                    Bonelli Editore.
		    <?php
			if (!isset($_COOKIE['username'])) {
			    echo '</h3>';
			} else {
			    echo '</br>';
			    echo '</br>';
			    echo '<b>';
			    echo 'Hi, ' . $_COOKIE['username'];
			    echo '</b>';
                            echo '&nbsp&nbsp&nbsp';
                            echo '<a href = \'logout_cookie.php\' class = \'btn btn-light\'>';
                            echo 'Logout';
                            echo '</a>';
			    echo '</h3>';
			}
		    ?>
            </div>
            <div id = 'right'>
                <img src = '/images/superciuk.gif' class = 'header_img' />
                <img src = '/images/larsen.png' class = 'header_img' />
                <img src = '/images/tdkr.jpg' class = 'header_img' />
                <img src = '/images/zagor.png' class = 'header_img' />
            </div>
        </header>
        <?php
            if (!isset($_COOKIE['username'])) {
                echo '<h3>';
                echo 'To buy comic books you must be logged in';
                echo '<a href = \'register.html\' class = \'btn btn-primary\'>';
                echo 'Go to login';
                echo '</h3>';
            } else {
                $userName = $_COOKIE['username'];
                include(connect_reg.php);
                $sql = "SELECT userID FROM userData WHERE email = '$userName'";
                $result = (mysqli_query($conn, $sql));
                if ($result) {
                    if (mysqli_num_rows != 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($row as $key => $val) {
                                $userID = $val;
                            }
                        }
                    } else {
                        echo 'Check your email and ' . '<a href = \'register.html\'>' . 'try again' . '</a>';
                    }
                } else {
                    mysqli_error($conn);
                }
                mysqli_close($conn);
                include(connect.php);
                $sql2 = "INSERT INTO transaction(aUser) VALUES('$userID')";
                if (mysqli_query($conn, $sql2)) {
                    $sql3 = "SELECT MAX(transactionID) FROM transaction";
                    $result = mysqli_query($conn, $sql3);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($row as $key => $val) {
                                $transactionID = $val;
                            }
                        }
                    } else {
                        mysqli_error($conn);
                    }
                } else {
                    mysqli_error($conn);
                }
                $cbID = $_GET['cbID'];
                $sql4 = "INSERT INTO buying(transaction, comicBook, buyingDate) VALUES('$transactionID', '$cbID', '$date');";
                if (mysqli_query($conn, $sql4)) {
                    echo 'Congratulation for buying your comic book';
                } else {
                    mysqli_error($conn);
                }
            }
        ?>
        <script>
            productsArray = <?php echo json_encode($products); ?>;
            productsSection = document.querySelector('#products');
            for (let i = 0; i < productsArray.length; i++) {
                let product = new comicBookCard(productsArray[i]['publisherName'], productsArray[i]['seriesName'], productsArray[i]['datePublished'], productsArray[i]['issueNumber'], productsArray[i]['coverTitle'], productsArray[i]['nrPages'], productsArray[i]['price'], productsArray[i]['description'], productsArray[i]['coverFolder'], productsArray[i]['wFirstName'], productsArray[i]['wLastName'], productsArray[i]['aFirstName'], productsArray[i]['aLastName']);
                productsSection.appendChild(product.makeElement());
            }
        </script>
        </section>
        <footer title = 'contactus'>
            <h3>For any info:</h3>
            <a href = 'contact_us.html' class = 'back_home_button btn btn-outline-primary'>Contact us</a>
            <br/>
            <h4 align = 'center'>Comic books'r us SRL</h4>
            <h4 align = 'center'>P.zza Pugliatti 1, 98122 Messina</h4>
            <h4 align = 'center'><a href = 'mailto:comicsrus@email.comics'>email: comicsrus@email.comics</a></h4>
            <h5 align = 'left'>All images used in this website are copyrights &#169; of the respective publisher.</h5>
        </footer>
    </body>
</html>
