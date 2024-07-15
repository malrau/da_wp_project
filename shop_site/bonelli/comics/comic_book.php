<!DOCTYPE html>
<html>
    <head>
        <?php
        echo "<a href '../'></a>";
        //$_SERVER['SCRIPT_FILENAME'];
        //echo $pub;
        $series = $_GET['series'];
        $title = $_GET['coverTitle'];
        echo "<title>" . $series . ' - ' . $title . "</title>";
        ?>
        <meta charset="UTF-8">
        <link rel = 'stylesheet' href = '/shopStyle.css' />
        <link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
	<script type = 'text/javascript' src = '/buildComicBookCard.js' /></script>
    </head>
    <body>
        <header>
            <div id = 'left'>
                <h1><a href = '/index.php'>Comic books'r us</a></h1>
                <h3>
                    The best place to buy comic books from the top comic book
                    publishers such as American Marvel and DC Comics or Italian Sergio 
                    Bonelli Editore.
                </h3>
            </div>
            <div id = 'right'>
                <img src = '/images/superciuk.gif' class = 'header_img' />
                <img src = '/images/larsen.png' class = 'header_img' />
                <img src = '/images/tdkr.jpg' class = 'header_img' />
                <img src = '/images/zagor.png' class = 'header_img' />
            </div>
        </header>
        <?php
            include('../../connect.php');
            $cbID = $_GET['id'];
            $sql = "SELECT R.publisherName, S.seriesName, C.datePublished, C.issueNumber, C.coverTitle, C.nrPages, C.price, C.description, C.coverFolder, W.firstName AS wFirstName, W.lastName AS wLastName, D.firstName AS aFirstName, D.lastName AS aLastName FROM comicBook AS C, publishing AS P, publisher AS R, belonging AS B, series AS S, authoring AS A, writer AS W, artist AS D WHERE C.cbID = B.comicBook AND B.series = S.seriesName AND S.seriesName = P.series AND P.publisher = R.publisherName AND C.cbID = A.comicBook AND A.writer = W.writerID AND A.artist = D.artistID AND C.cbID = $cbID;";
            $result = mysqli_query($conn, $sql);
            $products = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
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
            <a href = '../../contact_us.html'>Contact us</a>
            <br/>
            <h4 align = 'center'>Comic books'r us SRL</h4>
            <h4 align = 'center'>P.zza Pugliatti 1, 98122 Messina</h4>
            <h4 align = 'center'><a href = 'mailto:comicsrus@email.comics'>email: comicsrus@email.comics</a></h4>
            <h5 align = 'left'>All images used in this website are copyrights &#169; of the respective publisher.</h5>
        </footer>
    </body>
</html>
