import Masonry from './masonry.pkgd.min.js'; // Masonryをインポート
import imagesLoaded from './imagesloaded.pkgd.min.js'; // imagesLoadedをインポート

document.addEventListener('DOMContentLoaded', function () {
  var elem = document.querySelector('.masonry-gallery');
  if (elem) {
    imagesLoaded( elem, function() {
      var msnry = new Masonry( elem, {
        itemSelector: '.masonry-gallery-item',
        columnWidth: 395,
        gutter: 25,
        percentPosition: false
      });
    });
  }
}); 