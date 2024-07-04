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
    // general purpose <br> and <p> tags
    let br = document.createElement('br');
    let p = document.createElement('p');

    // section
    let cardSection = document.createElement('div');
    cardSection.className = 'marvelcb';
    
    // image child (contains cover image)
    let cardImg = document.createElement('img');
    cardImg.src = this.folder;
    cardImg.className = 'cbimg';
    
    // h2 child (contains series and title)
    let cardH3 = document.createElement('h3');
    cardH3.className = 'cbtitle';
    let cardPSeries = document.createElement('p');
    let cardH3Series = document.createTextNode(this.series + ' - ' + this.number);
    cardPSeries.appendChild(cardH3Series);
    let cardPTitle = document.createElement('p');
    let cardH3Title = document.createTextNode(this.title);
    cardPTitle.appendChild(cardH3Title);
    cardH3.appendChild(cardPSeries);
    cardH3.appendChild(br);
    cardH3.appendChild(cardPTitle);
    
    // h3 child (contains date, pages and price)
    let cardH4 = document.createElement('h4');
    let cardPDate = document.createElement('p');
    let cardH4Date = document.createTextNode('Published: ' + this.date);
    cardPDate.appendChild(cardH4Date);
    let cardPPages = document.createElement('p');
    let cardH4Pages = document.createTextNode('Pages: ' + this.pages);
    cardPPages.appendChild(cardH4Pages);
    let cardPPrice = document.createElement('p');
    let cardH4Price = document.createTextNode('Price: ' + this.price);
    cardPPrice.appendChild(cardH4Price);
    cardH4.appendChild(cardPDate);
    cardH4.appendChild(br);
    cardH4.appendChild(cardPPages);
    cardH4.appendChild(br);
    cardH4.appendChild(cardPPrice);
    cardH4.appendChild(br);
    cardH4.appendChild(br);
    cardH4.appendChild(br);
    
    // div child (contains description)
    let cardDescriptionDiv = document.createElement('div');
    cardDescriptionDiv.className = 'cbdes';
    let cardDescription = document.createTextNode(this.description);
    cardDescriptionDiv.appendChild(cardDescription);
    cardDescriptionDiv.appendChild(br);
    
    // div child (contains authors)
    let cardAuthorsDiv = document.createElement('div');
    let cardWriter = document.createTextNode('Story: ' + this.writerFirstName + ' ' + this.writerLastName);
    let cardArtist = document.createTextNode('Drawings: ' + this.artistFirstName + ' ' + this.artistLastName);
    cardAuthorsDiv.appendChild(cardWriter);
    cardAuthorsDiv.appendChild(br);
    cardAuthorsDiv.appendChild(cardArtist);
    cardAuthorsDiv.appendChild(br);

    // div child (contains navigation buttons)
    let cardNavigationDiv = document.createElement('div');
    cardNavigationDiv.className = 'navigation';
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
    cardSection.appendChild(cardH3);
    cardSection.appendChild(cardH4);
    cardSection.appendChild(cardDescriptionDiv);
    cardSection.appendChild(cardAuthorsDiv);
    cardSection.appendChild(cardNavigationDiv);
    
    return cardSection;
};

document.addEventListener('DOMContentLoaded', function () {
    let productsSection = document.querySelector('#products');
    productsSection.id = 'product';
    });