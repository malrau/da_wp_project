<!DOCTYPE html>
<html>

    <head>
        <title>Comic books'r us</title>
        <meta charset="UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = 'stylesheet' href = 'shopStyle.css' />
        <link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
    </head>

    <body id = 'login'>
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
            /* Use date to update the lastLogin attribute in the userData table 
               of the comicsShopUsers database */
            $userName = $_POST['userName'];
            $password = $_POST['userPassword'];
            $date = date('Y-m-d');

			/* Password check */
			$sql_check = "SELECT pwd FROM userData WHERE email = '$userName'";
			$result = mysqli_query($conn, $sql_check);
			if ($result) {
				if (mysqli_num_rows($result) == 0) {
					echo 'Check your email and ' . '<a href = \'register.html\'>' . 'try again' . '</a>';
				} else {
					while ($row = mysqli_fetch_assoc($result)) {
						foreach ($row as $key => $val) {
							// if password is not equal to that in the database, try login again
							if ($password != $val) {
								echo 'Check your password and ' . '<a href = \'register.html\'>' . 'try again' . '</a>';
								// if password is equal to that in the database, connect
							} else {
								$sql = "UPDATE userData SET lastLogin = '$date' WHERE email = '$userName'";
								if (mysqli_query($conn, $sql)) {
									$sql2 = "SELECT firstName FROM userData Where email = '$userName'";
									$result2 = mysqli_query($conn, $sql2);
									if ($result2) {
										while ($row = mysqli_fetch_assoc($result2)) {
											foreach ($row as $key => $val) {
												echo '</br>';
												echo '<section style = \'position : relative; left: 5em\'>';
												echo '<form method = \'post\' action = \'login_cookie.php\'>';
												echo "<input type = 'hidden' name = 'userName' value = $userName>";
												echo "<input type = 'hidden' name = 'userFirstName' value = $val>";
												echo '<input type = \'submit\' value = \'Confirm login\' class = \'btn btn-outline-primary\'/>';
												echo '</section>';
											}
										}
									} else {
										mysqli_error($conn);
									}
								} else {
									mysqli_error($conn);
								}
							}
						}
					}
				}
			} else {
				mysqli_error($conn);
			}

					
						/* manage user data to create cookies for persistent state */
					
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
