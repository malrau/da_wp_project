<!DOCTYPE html>
<html>

    <head>
        <title>Comic books'r us</title>
        <meta charset="UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = 'stylesheet' href = 'shopStyle.css' />
        <link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
        <script type = 'text/javascript' src = '/buildBestSellerSmallCard.js'></script>
        <!script type = 'text/javascript' src = 'shopScript.js'/script-->
    </head>

    <body id = 'home'>
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
			    echo 'Hi, ' . $_COOKIE['username'];
			}
		    ?>
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
            include('connect.php');
            /* create a view which acts as an inner query for the following query.
            In fact the view is used as a table related to the other ones in the query */
            $sqlView = "CREATE OR REPLACE VIEW innerQuery AS SELECT C.cbID, COUNT(*) AS count FROM comicBook AS C, buying AS B, transaction AS T WHERE c.cbID = B.comicBook AND T.transactionID = B.transaction GROUP BY C.cbID;";
            $sql = "SELECT R.publisherName, S.seriesName, C.cbID, C.datePublished, C.issueNumber, C.coverTitle, C.price, C.coverFolder, I.count FROM series AS S, comicBook AS C, belonging AS B, publisher AS R, publishing AS P, innerQuery AS I WHERE C.cbID = B.comicBook AND S.seriesName = B.series AND S.seriesName = P.series AND P.publisher = R.publisherName AND C.cbID = I.cbID ORDER BY I.count DESC;";
            $createView = mysqli_query($conn, $sqlView);
            $result = mysqli_query($conn, $sql);
            
            $bestSellers = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $bestSellers[] = $row;
            }
        ?>
            <script>
                let bestSellersArray = <?php echo json_encode($bestSellers); ?>;
                productsSection = document.querySelector('#products');
                for(let i = 0; i < 8; i++) {
                    let product = new comicBookSmallCard(bestSellersArray[i]['publisherName'], bestSellersArray[i]['seriesName'], bestSellersArray[i]['cbID'], bestSellersArray[i]['datePublished'], bestSellersArray[i]['issueNumber'], bestSellersArray[i]['coverTitle'], bestSellersArray[i]['price'], bestSellersArray[i]['coverFolder']);
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
