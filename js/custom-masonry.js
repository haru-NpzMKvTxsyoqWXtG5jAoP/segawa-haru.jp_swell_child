document.addEventListener('DOMContentLoaded', function () {
  // メイソンリーレイアウトを適用するコンテナ要素を取得
  var elem = document.querySelector('.masonry-gallery');
  if (elem) {
    // まず、elem（.masonry-gallery）の中の画像が全部読み込まれるのを待つ
    imagesLoaded( elem, function() {
      // 画像が全部読み込まれたら、ここからMasonryの処理を始める！
      var msnry = new Masonry( elem, {
        // オプション
        itemSelector: '.masonry-gallery-item',
        columnWidth: '.grid-sizer', // ← '.grid-sizer' を指定
        gutter: 15, // アイテム間の隙間 (25から15に変更)
        percentPosition: true // ← true のまま
      });
    });
  }
}); 