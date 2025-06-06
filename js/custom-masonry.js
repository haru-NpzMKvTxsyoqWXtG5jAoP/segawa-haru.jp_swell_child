// Masonry初期化用のカスタムスクリプト（最小構成版）
document.addEventListener('DOMContentLoaded', function () {
  var galleryContainer = document.querySelector('.masonry-gallery');

  if (galleryContainer) {
    // 画像が全部読み込まれたらMasonryを実行する (これは必須！)
    imagesLoaded(galleryContainer, function () {
      
      var msnry = new Masonry(galleryContainer, {
        itemSelector: '.masonry-gallery-item', // まずは通常アイテムだけを対象にする
        columnWidth: '.grid-sizer',         // 幅の基準は.grid-sizerから取る
        gutter: 15,                         // CSSの計算と完全に同じ値に！
        percentPosition: true,              // calcで%を使ってるから、trueの方がキレイに配置されやすい
        transitionDuration: '0.2s'          // 再配置時に0.2秒かけてフワッと動くように（お好みで）
      });

      // ウィンドウサイズが変わった時にも再レイアウトさせる（デバウンス処理付き）
      // これがないと、ウィンドウ幅を変えた時にレイアウトが崩れる
      let resizeTimeout;
      window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
          if (msnry) {
            msnry.layout();
          }
        }, 250); // リサイズが終わってから0.25秒後に再計算
      });

    });
  }
}); 