const carouselDiv = document.querySelector('.carousel-inner');
const carouselImgSrc = ["c2.jpg", "c3.jpg", "c4.jpg", "c5.jpg", "c1.jpg", "c7.jpg", "c8.jpg",]

// Carousel  STUFFS
shuffle(carouselImgSrc);
function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;
  // While there remain elements to shuffle...
  while (0 !== currentIndex) {
    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;
    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }
  return array;
}

for (let item of carouselImgSrc){
	carouselDiv.innerHTML += `<div class='carousel-item'>
								<img class='d-block w-100' src='assets/images/${item}'>
							</div>`;
};



