/* ************************************** */
/* ************************************** */
/*     script to build a comic book
      thumbnail object with properties    
                 and methods              */
/* ************************************** */
/* ************************************** */

function comicBookSmallCard(cbID, seriesName, datePublished, issueNumber,
                            coverTitle, price, coverFolder) {
                                this.id = cbID;
                                this.series = seriesName;
                                this.date = datePublished;
                                this.number = issueNumber;
                                this.title = coverTitle;
                                this.price = price;
                                this.fileName = coverFolder;
}
comicBookSmallCard.prototype.makeElement = function() {
    
    // general purpose <br> tag
    let br = document.createElement('br');

    // section
    let card = document.createElement('div');
    card.id = this.id;
    card.className = 'list_cb';
    
    // image child (contains cover image and link to comic book details)
    let cardImgAnchor = document.createElement('a');
    cardImgAnchor.href = 'comics/comic_book.php?id=' + this.id + '&series=' + this.series + '&coverTitle=' + this.title;
    let cardImg = document.createElement('img');
    cardImg.src = 'covers/' + this.series + '/' + this.fileName;
    cardImg.className = 'list_thumbnail';
    cardImgAnchor.appendChild(cardImg);
    
    // main p child (contains series, title and another p element with date and price)
    let cardPMain = document.createElement('p');
    cardPMain.className = 'list_title';
    let cardPAnchor = document.createElement('a');
    cardPAnchor.href = 'comics/comic_book.php?id=' + this.id + '&series=' + this.series + '&coverTitle=' + this.title;
    let cardPAnchorTitle = document.createTextNode(this.series + ' #' + this.number + ' - ' + this.title);
    cardPAnchor.appendChild(cardPAnchorTitle);
    let cardPInfo = document.createElement('p');
    cardPInfo.className = 'list_info';
    let cardPDate = document.createTextNode('Published: ' + this.date);
    let cardPPrice = document.createTextNode('€ ' + this.price);
    cardPInfo.appendChild(cardPDate);
    cardPInfo.appendChild(br);
    cardPInfo.appendChild(cardPPrice);
    cardPMain.appendChild(cardPAnchor);
    cardPMain.appendChild(cardPInfo);
    
    // append all elements to the card div
    card.appendChild(cardImgAnchor);
    card.appendChild(cardPMain);
    
    return card;
};