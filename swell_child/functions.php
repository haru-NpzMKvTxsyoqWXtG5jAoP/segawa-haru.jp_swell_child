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
