<!DOCTYPE html>
<html>
    <head>
        <title>Marvel Comics</title>
        <meta charset="UTF-8">
        <link rel = 'stylesheet' href = '/shopStyle.css' />
        <link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
	<script type = 'text/javascript' src = 'marvelPage.js'></script>
	<script type = 'text/javascript' src = '/buildComicBookSmallCard.js' /></script>
	<script type = 'text/javascript' src = '/buildPublisherPage.js' /></script>
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
        <nav class = 'bg-light'>
            <h4>Select a publisher to see a list of comic books</h4>
            <ul>
                <li class = 'homelist'>
                    <a href = '/marvel/marvel.php'><img src = '/images/Marvel-Comics-Logo.png' title = 'Marvel Comics' height = '60' /></a>
                </li>
                <li class = 'homelist'>
                    <a href = '/dc/dc.php'><img src = '/images/DC-comics-logo.png' title = 'DC Comics' height = '80' /></a>
                </li>
                <li class = 'homelist'>
                    <a href = '/bonelli/bonelli.php'><img src = '/images/bonelli-logo.png' title = 'Sergio Bonelli Editore' height = '60' /></a>
                </li>
            </ul>
            <p>
                <a href = '/index.php' class = 'back_home_button btn btn-outline-primary'>Back home</a>
            </p>
        </nav>
	<?php
	    include('../connect.php');
	    
            // query the database to retrieve comic books information
            $sql = "SELECT S.seriesName, C.cbID, C.datePublished, C.issueNumber, C.coverTitle, C.nrPages, C.price, C.description, C.coverFolder, W.firstName, W.lastName, D.firstName, D.lastName FROM comicBook AS C, publishing AS P, publisher AS R, belonging AS B, series AS S, authoring AS A, writer AS W, artist AS D WHERE C.cbID = B.comicBook AND B.series = S.seriesName AND S.seriesName = P.series AND P.publisher = R.publisherName AND C.cbID = A.comicBook AND A.writer = W.writerID AND A.artist = D.artistID AND R.publisherName = 'Marvel comics';";
	    $result = mysqli_query($conn, $sql);
            
            // fetch the data from the result set and put them into an array of arrays
            /* start by putting the field names into an array. Field names will
               serve as keys in the associative array. The final array is indexed
               numerically */
            $keys = array();
            $info = mysqli_fetch_fields($result);
            foreach ($info as $val) {
                $keys[] = $val -> name;
            }
            $length = count($keys);
            
            $products = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
            /*  print some data from the products array for testing
            for ($i = 0; $i < count($products); $i++) {
                echo $products[$i]['seriesName'];
                echo ' - ';
                echo $products[$i]['coverFolder'];
            }
            */
        ?>
            <script>
                let productsArray = <?php echo json_encode($products); ?>;
                productsSection = document.querySelector('#products');
                for(let i = 0; i < productsArray.length; i++) {
                    let product = new comicBookSmallCard(productsArray[i]['cbID'], productsArray[i]['seriesName'], productsArray[i]['datePublished'], productsArray[i]['issueNumber'], productsArray[i]['coverTitle'], productsArray[i]['price'], productsArray[i]['coverFolder']);
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
