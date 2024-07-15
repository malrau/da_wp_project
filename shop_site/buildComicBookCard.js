/* ************************************** */
/* ************************************** */
/*     script to build a comic book
    object with properties and methods   */
/* ************************************** */
/* ************************************** */

function comicBookCard(publisherName, seriesName, datePublished,
                       issueNumber, coverTitle, nrPages, price,
                       description, coverFolder, writerFirstName,
                       writerLastName, artistFirstName, artistLastName) {
                           this.publisher = publisherName;
                           this.series = seriesName;
                           this.date = datePublished;
                           this.number = issueNumber;
                           this.title = coverTitle;
                           this.pages = nrPages;
                           this.price = price;
                           this.description = description;
                           this.fileName = coverFolder;
                           this.writerFirstName = writerFirstName;
                           this.writerLastName = writerLastName;
                           this.artistFirstName = artistFirstName;
                           this.artistLastName = artistLastName;
}
comicBookCard.prototype.makeElement = function() {
    // general purpose <br> and <p> tags
    let br = document.createElement('br');
    let p = document.createElement('p');

    // main div container and article and aside descendants
    let cardDiv = document.createElement('div');
    cardDiv.className = 'marvelcb';
    let cardArticle = document.createElement('article');
    let cardAside = document.createElement('aside');
    
    // image child (contains cover image)
    let cardImg = document.createElement('img');
    cardImg.className = 'cbimg';
    if (this.publisher == 'Marvel Comics') {
        cardImg.src = '/marvel/covers/' + this.series + '/' + this.fileName;
    } else if (this.publisher == 'DC Comics') {
        cardImg.src = '/dc/covers/' + this.series + '/' + this.fileName;
    } else if (this.publisher == 'Sergio Bonelli Editore') {
        cardImg.src = '/bonelli/covers/' + this.series + '/' + this.fileName;
    }
    
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
    cardH4.className = 'info';
    let cardPDate = document.createElement('p');
    let cardH4Date = document.createTextNode('Published: ' + this.date);
    cardPDate.appendChild(cardH4Date);
    let cardPPages = document.createElement('p');
    let cardH4Pages = document.createTextNode('Pages: ' + this.pages);
    cardPPages.appendChild(cardH4Pages);
    let cardPPrice = document.createElement('p');
    let cardH4Price = document.createTextNode('Price: € ' + this.price);
    cardPPrice.appendChild(cardH4Price);
    cardH4.appendChild(cardPDate);
    cardH4.appendChild(cardPPages);
    cardH4.appendChild(cardPPrice);
    
    // attach H3 and H4 elements to aside element
    cardAside.appendChild(cardH3);
    cardAside.appendChild(cardH4);
    
    // div child (contains description)
    let cardDescriptionDiv = document.createElement('div');
    cardDescriptionDiv.className = 'cbdes';
    let cardDescription = document.createTextNode(this.description);
    cardDescriptionDiv.appendChild(cardDescription);
    cardDescriptionDiv.appendChild(br);
    
    // div child (contains authors)
    let cardAuthorsDiv = document.createElement('div');
    cardAuthorsDiv.className = 'authors';
    let cardPWriter = document.createElement('p');
    let cardWriter = document.createTextNode('Story: ' + this.writerFirstName + ' ' + this.writerLastName);
    cardPWriter.appendChild(cardWriter);
    let cardPArtist = document.createElement('p');
    let cardArtist = document.createTextNode('Drawings: ' + this.artistFirstName + ' ' + this.artistLastName);
    cardPArtist.appendChild(cardArtist);
    cardAuthorsDiv.appendChild(cardPWriter);
    cardAuthorsDiv.appendChild(cardPArtist);

    // div child (contains navigation buttons)
    let cardNavigationDiv = document.createElement('div');
    cardNavigationDiv.className = 'navigation';
    let cardBackP = document.createElement('p');
    let cardBackA = document.createElement('a');
    if (this.publisher == 'Sergio Bonelli Editore') {
        cardBackA.href = '/bonelli/bonelli.php';
    } else if (this.publisher == 'DC Comics') {
        cardBackA.href = '/dc/dc.php';
    } else if (this.publisher == 'Marvel Comics') {
        cardBackA.href = '/marvel/marvel.php';
    }
    cardBackA.className = 'btn btn-primary';
    let cardBackText = document.createTextNode('Back to the ' + this.publisher + ' page');
    cardBackA.appendChild(cardBackText);
    cardBackP.appendChild(cardBackA);
    let cardHomeP = document.createElement('p');
    let cardHomeA = document.createElement('a');
    cardHomeA.href = '/index.php';
    cardHomeA.className = 'btn btn-primary';
    let cardHomeText = document.createTextNode('Back to the main page of the shop');
    cardHomeA.appendChild(cardHomeText);
    cardHomeP.appendChild(cardHomeA);
    cardNavigationDiv.appendChild(cardBackP);
    cardNavigationDiv.appendChild(cardHomeP);
    
    // attach H3 and H4 elements to article element
    cardArticle.appendChild(cardDescriptionDiv);
    cardArticle.appendChild(cardAuthorsDiv);
    cardArticle.appendChild(cardNavigationDiv);
    
    // append all elements to the card div
    cardDiv.appendChild(cardImg);
    cardDiv.appendChild(cardAside);
    cardDiv.appendChild(cardArticle);
    
    return cardDiv;
};

document.addEventListener('DOMContentLoaded', function () {
    let productsSection = document.querySelector('#products');
    productsSection.id = 'product';
    });