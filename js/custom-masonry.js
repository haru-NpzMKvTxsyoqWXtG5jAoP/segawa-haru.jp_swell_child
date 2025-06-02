window.addEventListener('load', function () {
  // メイソンリーレイアウトを適用するコンテナ要素を取得
  var elem = document.querySelector('.masonry-gallery');
  if (elem) {
    // まず、elem（.masonry-gallery）の中の画像が全部読み込まれるのを待つ
    imagesLoaded( elem, function() {
      // imagesLoadedのコールバック全体をsetTimeoutで遅らせる
      setTimeout(function() {
        var msnry = new Masonry( elem, {
          // オプション
          itemSelector: '.masonry-gallery-item',
          columnWidth: 395, // ← 固定ピクセル値に変更
          gutter: 25, // アイテム間の隙間
          percentPosition: false // 幅が%指定なのでfalseに変更
        });
        msnry.layout(); // layout() を再度呼び出す
      }, 200); // 遅延を200ミリ秒に増やしてみる
    });
  }
}); 