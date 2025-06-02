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
        columnWidth: '.masonry-gallery-item', // 列の幅をアイテムの幅に合わせる場合
        gutter: 25, // アイテム間の隙間（CSSで設定したgapと合わせると良い）
        percentPosition: true
      });
    });
  }
}); 