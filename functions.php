<?php

/* 子テーマのfunctions.phpは、親テーマのfunctions.phpより先に読み込まれることに注意してください。 */


/**
 * 親テーマのfunctions.phpのあとで読み込みたいコードはこの中に。
 */
// add_filter('after_setup_theme', function(){
// }, 11);


/**
 * 子テーマでのファイルの読み込み
 */
add_action('wp_enqueue_scripts', function() {
	
	$timestamp = date( 'Ymdgis', filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_style( 'child_style', get_stylesheet_directory_uri() .'/style.css', [], $timestamp );

	/* その他の読み込みファイルはこの下に記述 */

	// Masonry.js ライブラリ本体を読み込む
	$masonry_timestamp = date( 'Ymdgis', filemtime( get_stylesheet_directory() . '/js/masonry.pkgd.min.js' ) );
	wp_enqueue_script( 'masonry-pkgd', get_stylesheet_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), $masonry_timestamp, true );

	// imagesLoaded.js ライブラリを読み込む
	$imagesloaded_timestamp = date( 'Ymdgis', filemtime( get_stylesheet_directory() . '/js/imagesloaded.pkgd.min.js' ) );
	wp_enqueue_script( 'imagesloaded', get_stylesheet_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), $imagesloaded_timestamp, true );

	// Masonry 初期化用のカスタムスクリプトを読み込む (Masonry と imagesLoaded に依存)
	$custom_masonry_timestamp = date( 'Ymdgis', filemtime( get_stylesheet_directory() . '/js/custom-masonry.js' ) );
	wp_enqueue_script( 'custom-masonry', get_stylesheet_directory_uri() . '/js/custom-masonry.js', array('masonry-pkgd', 'imagesloaded'), $custom_masonry_timestamp, true );

}, 11);

/**
 * カスタムの縦型ヘッダーを生成し、メニューを配置する
 */
function add_custom_vertical_header() {
    // ヘッダーを表示したくないページ（例: LP）では何もしない
    if ( is_page_template( 'lp.php' ) ) {
        return;
    }

    // 新しい縦型ヘッダーのHTMLを生成
    ?>
    <header class="custom-vertical-header">
        <nav class="custom-vertical-nav">
            <?php
            // SWELLのグローバルナビゲーション('swell_gnav')に設定されたメニューを動的に出力
            wp_nav_menu( array(
                'theme_location' => 'header_menu', // ★正しいメニュー名に修正
                'container'      => false, // 余分なコンテナdivを生成しない
                'menu_class'     => 'custom-vertical-menu-list', // ul要素に付与するCSSクラス
                'fallback_cb'    => false, // メニューが存在しない場合に何もしない
            ) );
            ?>
        </nav>
    </header>
    <?php
}

function setup_custom_header() {
    add_action( 'wp_body_open', 'add_custom_vertical_header' );
}
add_action( 'init', 'setup_custom_header' );

function add_adobe_fonts_script() {
  // Adobe Fontsのスクリプト
  $script = <<<EOD
<script>
  (function(d) {
    var config = {
      kitId: 'bew5wgt',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
EOD;
  
  // headタグの最後にスクリプトを出力
  echo $script;
}
add_action( 'wp_head', 'add_adobe_fonts_script' );
