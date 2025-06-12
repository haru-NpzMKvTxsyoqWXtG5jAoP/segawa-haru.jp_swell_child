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
                'theme_location' => 'swell_gnav', // SWELLのグローバルナビと同じメニューを利用
                'container'      => false, // 余分なコンテナdivを生成しない
                'menu_class'     => 'custom-vertical-menu-list', // ul要素に付与するCSSクラス
                'fallback_cb'    => false, // メニューが存在しない場合に何もしない
            ) );
            ?>
        </nav>
    </header>
    <?php
}

/**
 * カスタムヘッダーのセットアップを適切なタイミングで行う
 */
function setup_custom_header() {
    add_action( 'wp_body_open', 'add_custom_vertical_header' );
}
add_action( 'init', 'setup_custom_header' );
