-- 540438 - Maurizio La Rosa --
===============================

<p>
This repository hosts the project for the exam of the Web Programming course of the Data Analysis degree of the University of Messina. The project requires building a web or mobile application that interacts with a database and manages users with various privileges with respect to the various functions implemented within the application.
Use of HTML, CSS and JavaScript is also mandatory.
</p>
<p>
One of the project possibilities is the implementation of a web portal (or mobile application) to buy and sell products. I'll focus on this and specifically on a portal for selling and buying comic books.
</p>
<p>
<h3>Main database</h3>
The data are stored in a relational database containing 5 entities providing information about the products (the actual comic book sold, the series to which it belongs, the editor that publishes it and the authors (writer and artist) and 3 relationships connecting them. One more entity is dedicated to store data about the transactions (the action of buying a comic book), which is connected to the comic book entity by means of the <i>buying</i> relationship. In a more recent version of the project, I altered the <i>transaction</i> entity by adding one attribute to it. The attribute name is <i>aUser</i>, which corresponds to the ID of the user who has made the transaction. This information is not internal to the products database, in fact it comes from the user management database and it can be used to retrieve information about the user by querying that database separately from the products database.
</br>
Here is the representation of the conceptual and relational schemas:
<img src = 'https://github.com/malrau/da_wp_project/blob/main/schema/e-r_model.png' />
</p>
<p>
<h3>User management database</h3>
User data are stored in a different database. It contains three entities and two relationships linking them. The entities are the user with relevant user data, the user's role and the permission associated with the role. For simplification, I only set up two user roles: <i>administrator</i>, which can make changes to the products database (add, remove or update products), <i>customer</i>, which can buy products. Permissions are primarily operated by only allowing administrators to be directed to the page designed to interact with the products database. 
</br>
The only way to create role types (and permissions as well) is by direct interaction with the comicsShopUsers MySQL database, with INSERT queries like the following:
<ul>
<li>INSERT INTO userRole(roleName, description) VALUES('admin', 'Can perform INSERT, DELETE and UPDATE actions on the products database');</i>
<li>INSERT INTO userRole(roleName, description) VALUES('customer', 'Can buy products: action only affects the transaction table of the products database');</li>
<li>INSERT INTO permission(permissionName, description) VALUES('make_changes', 'Can perform INSERT, DELETE and UPDATE actions on the products database');</li>
<li>INSERT INTO permission(permissionName, description) VALUES('buy', 'Can buy products: action only affects the transaction table of the products database');</li>
</ul>
From a practical point of view, with the current implementation, the <i>customer</i> user role is associated exclusively with the <i>buy</i> permission and the <i>admin</i> user role is exclusively associated with the <i>make_changes</i> permission, so it would not be necessary to have two tables, and permissions could simply be attributes of the userRole table or, even more, the roleName attribute would be sufficient to determine the associated permissions. However, in principle, while each userRole can determine one and only one permission, one permission could be associated to more than one role. This is not implemented, however, at this stage.
</br>
Some form of database user management is better be implemented as well.
</br>
Here is the representation of the conceptual and relational schemas:
<img src = 'https://github.com/malrau/da_wp_project/blob/main/schema/e-r_model_users.png' /></p>
<p>
</br>
<h3>Structure of the web site</h3>
The web site has a main page with a simple structure. I keep the <i>head</i> and <i>body</i> elements: the head stores the references to the stylesheets used to set the style properties and improve the presentation of the markup elements and to the scripts used to perform various types of client-side tasks. The content of the web page is in the body, which has four main elements:
<ul>
<li>a header, placed on top of the page, containing the store logo and distinctive images;</li>
<li>a navigation panel, placed on the left, containing a clickable list of comic book publishers referencing their site pages;</li>
<li>a central section showing the best selling comic books;</li>
<li>a footer containing information about the web site and referencing a page for requesting help.</li>
</ul>
This layout is entirely replicated in the publishers' pages, where the central section element shows the entire publisher's catalogue. Each comic book of the catalogue is displayed in the form of a small rectangular card which shows the cover as a thumbnail image, the series name, the issue number, the title, the date of publication and the price. By clicking on the title or image one is redirected to a page entirely dedicated to the selected comic book. This page keeps the site header and footer, but it has no navigation panel and the central section is designed differently with respect to the publishers' and main page sections. The different behaviour is toggled by its different class name (the class name of the home and publishers' pages is <i>products</i>, the classname of the comic book page is <i>product</i>). In this section the comic book cover appears as a larger image and, in addition to the information contained in the publisher's page, a description of the story, the number of pages and the authors are present. Moreover, this is the page from where the comic book can be bought.
The site also has a register/login functionality to help manage state and perform actions such as buying and adding/removing/updating products. The <i>register.html</i> page has two forms, one for registration (with <i>action</i>: registration.php), one for login (with <i>action</i>: login.php), if already registered. The first form allows inserting user data and profile into the user management database (this form only allows for the creation of customer roles, while administrator roles need interaction through the database API), the second one checks if the user is already present in the database and allows the creation of cookies that keep track of the buying process. The registration process forces the association of the new user to the <i>customer</i> user role with <i>buy</i> permissions. In fact the query that inserts the user ID into the establishing table hard codes roleID = 2, which is then associated to permission = 2 (permission to buy).
</p>
</br>
<h3>Server-side interactions</h3>
<p>
Server-side interactions are performed by embedding PHP code within HTML elements.In an earlier version of the website, PHP was used only in the publishers' pages and in the comic book pages. In the current version I also included in the home page. It is used not only to connect to the MySQL server to perform queries, but also to retrieve useful information from the request-response header which are stored in PHP superglobal variables like <i>$_SERVER</i> and <i>$_GET</i>. In particular, the publishers' pages, having .php extension embed PHP code in the body: it first calls the <i>connect.php</i> script to connect to the MySQL database where comic book information are stored. The <i>connect.php</i> script retrieves database and user information required for connection from a .ini file which is located in the root folder. It also retrieves the <i>SCRIPT_FILENAME</i> value from the <i>$_SERVER</i> superglobal. This value corresponds to the web page performing the HTML request. This page is one of the publisher pages, so by knowing this an "h3" element specific for the publisher is outputted in the same publisher page performing the request. This element is dinamically created, and it is useful because it allows for to have exactly equal publisher pages: although some content is different, it is dinamically created either via PHP (like in this case) or via JavaScript, while the code is the same in each publisher page. The result set of the query is then processed by the <i>mysqli_fetch_assoc()</i> function of the PHP <i>mysqli</i> MySQL driver</i>. Each row of the query is converted to a PHP associative array by <i>mysqli_fetch_assoc()</i> (this means that each row is an array of key-value pairs where the keys are the attribute names of the projection performed in the query, while the values are the record instances resulting from the selection process of the query). A new PHP array is built by indexing the records of the query result set already processed as associative arrays. By also embedding PHP in the home page, I perform a query which extracts the comic books that have been bought most times. The query counts the number of transactions associated with each unique (<i>DISTINCT</i>) comic book and orders them in descending order. By using JavaScript small cards are created for the first eight comic books in the list, which are shown in the home page of the web site. If transactions are performed that determine changes in the list of the best sellers, by refreshing the page the query is re-run and the new results are displayed in the home page.
</p>
</br>
<h3>Style sheets</h3>
<p>
I use two stylesheets to control the style of the website. The main one is custom, designed to control the appearance of the elements of the page and the page layout. It follows the organization of the web site, by stylizing the four main elements and their child elements. It makes use of classes and ids, which are mainly usde to identify descendants and specify their style. I also reference the <i>Bootstrap 5.3.3</i> version via Content Delivery Network (CDN). Bootstrap is used to stylize navigation buttons and forms. The main example of the use of Bootstrap to stylize forms is in the Register.html page. The registration form is organized thanks to the use of the <i>.row</i> and <i>.column</i> classes, which allow to create some sort of grid structure for form control elements. The login form is way simpler and does not need the use of this approach. Form control elements are stylized through the <i>.form-control</i> class. Some font-awesome icons also are included to provide some customization. The use of Bootstrap classes allows for a clean and pleasant appearance of the forms.
</p>
</br>
<h3>JavaScript</h3>
<p>
Contrary to previous versions of the website, I also add JavaScript in the main page of the shop (JavaScript was already a central element in the construction of the publishers' pages and of the detailed comic books pages). In addition to the two already included scriptss, i.e. <i>buildComicBookSmallCard.js</i> and <i>buildComicBookCard.js</i>, I create the script <i>buildBestSellerSmallCard.js</i>: this is analogous to the script <i>buildComicBookSmallCard.js</i>, but it includes a <i>publisher</i> property which is needed to implement a conditional for the name of the publisher. Depending on the publisher name, the image element of the card contains the reference to the correct publisher folder where the comic book images are located. This was not necessary in the <i>buildComicBookSmallCard.js</i> script because it operates within the publisher web page, hence the publisher folder reference is not needed.
</p>
<ul>
<p>
<li><i>buildComicBookSmallCard.js</i></li>
The first script is used by the publisher page. This page has php extension, because it perform some relevant server-side tasks. One of the challenges of using JavaScript was that of passing the PHP array built form the query result sets to Javascript for client-side manipulation. The <i>json_encode()</i> PHP function easily converts associative arrays to json objects: by embedding the PHP code with the function into JavaScript the object returned by the function can be assigned to a JavaScript variable for processing. At this point a for loop allows to loop through the array and retrieve information about the comic books returned by the query. This information is used by the <i>buildComicBookSmallCard.js</i> script to create small cards for the comic books in the query result set. The <i>buildComicBookSmallCard.js</i> script creates small card objects in the form of html "div" elements. Technically, it creates JavaScript objects where the objects' properties are the comic book attributes and only one method is present (<i>makeElement</i>), which exploits these properties to append elements to the main "div" element of the card. These elements are: the path where the comic book cover is stored, and information like the comic book series name, issue number and title, date of publication and price.
</p>
<p>
<li><i>buildComicBookCard.js</i></li>
The second script is used by the <i>comic_book.php</i> web page which is present within the <i>comics</i> folder of each publisher folder. This is a standard page which references the <i>buildComicBookCard.js</i> script for creating a more detailed and larger version of the comic book card. This script is very similar to the previous one. It creates card objects in the form of html "div" elements. The comic book attributes used as properties of the object are those used by the previous script and other ones: the description of the story, the number of pages of the comic book and the authors. The <i>makeElement</i> method exploits these properties to append elements to the main "div" element of the card and build a detailed comic book section of the comic book page.
</p>
</ul>
