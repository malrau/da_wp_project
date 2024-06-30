/* ************************************** */
/* ************************************** */
/*     script to build a comic book
    object with properties and methods   */
/* ************************************** */
/* ************************************** */

function comicBookCard(seriesName, datePublished, issueNumber,
                       coverTitle, nrPages, price, description,
                       coverFolder, writerFirstName, writerLastName,
                       artistFirstName, artistLastName) {
                           this.series = seriesName;
                           this.date = datePublished;
                           this.number = issueNumber;
                           this.title = coverTitle;
                           this.pages = nrPages;
                           this.price = price;
                           this.description = description;
                           this.folder = coverFolder;
                           this.writerFirstName = writerFirstName;
                           this.writerLastName = writerLastName;
                           this.artistFirstName = artistFirstName;
                           this.artistLastName = artistLastName;
}
comicBookCard.prototype.makeElement = function() {
    // general purpose <br> tag
    let br = document.createElement('br');

    // section
    let cardSection = document.createElement('section');
    cardSection.class = 'marvelcb';
    
    // image child (contains cover image)
    let cardImg = document.createElement('img');
    cardImg.src = this.folder;
    cardImg.class = 'cbimg';
    
    // h2 child (contains series and title)
    let cardH2 = document.createElement('h2');
    cardH2.class = 'cbtitle';
    let cardH2Series = document.createTextNode(this.series);
    let cardH2Title = document.createTextNode(this.number + this.title);
    cardH2.appendChild(cardH2Series);
    cardH2.appendChild(br);
    cardH2.appendChild(cardH2Title);
    
    // h3 child (contains date, pages and price)
    let cardH3 = document.createElement('h3');
    let cardH3Date = document.createTextNode('Published: ' + this.date);
    let cardH3Pages = document.createTextNode('Pages: ' + this.pages);
    let cardH3Price = document.createTextNode('Price: ' + this.price);
    cardH3.appendChild(cardH3Date);
    cardH3.appendChild(br);
    cardH3.appendChild(cardH3Pages);
    cardH3.appendChild(br);
    cardH3.appendChild(cardH3Price);
    cardH3.appendChild(br);
    cardH3.appendChild(br);
    cardH3.appendChild(br);
    
    // div child (contains description)
    let cardDescriptionDiv = document.createElement('div');
    cardDescriptionDiv.class = 'cbdes';
    let cardDescription = document.createTextNode(this.description);
    cardDescriptionDiv.appendChild(cardDescription);
    cardDescriptionDiv.appendChild(br);
    
    // div child (contains authors)
    let cardAuthorsDiv = document.createElement('div');
    let cardWriter = document.createTextNode('Story: ' + writerFirstName + ' ' + writerLastName);
    let cardArtist = document.createTextNode('Drawings: ' + artistFirstName + ' ' + artistLastName);
    cardAuthorsDiv.appendChild(cardWriter);
    cardAuthorsDiv.appendChild(br);
    cardAuthorsDiv.appendChild(cardArtist);
    cardAuthorsDiv.appendChild(br);

    // div child (contains navigation buttons)
    let cardNavigationDiv = document.createElement('div');
    cardNavigationDiv.class = 'navigation';
    let cardBackA = document.createElement('a');
    cardBackA.src = '../marvel.html';
    let cardBackText = document.createTextNode('Back to the Marvel Comics page');
    cardBackA.appendChild(cardBackText);
    let cardHomeA = document.createElement('a');
    cardHomeA.src = '../../[T]myShop.html';
    let cardHomeText = document.createTextNode('Back to the main page of the shop');
    cardHomeA.appendChild(cardHomeText);
    cardNavigationDiv.appendChild(cardBackA);
    cardNavigationDiv.appendChild(cardHomeA);
    
    // append all elements to the card section
    cardSection.appendChild(cardImg);
    cardSection.appendChild(cardH2);
    cardSection.appendChild(cardH3);
    cardSection.appendChild(cardDescriptionDiv);
    cardSection.appendChild(cardAuthorsDiv);
    cardSection.appendChild(cardNavigationDiv);
};