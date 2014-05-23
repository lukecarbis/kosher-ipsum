<?php
/*
Plugin Name: Kosher Ipsum - API
Description: Handles incoming API requests
Plugin URI: https://github.com/lukecarbis/kosher-ipsum
Version: 1.0
Author: Luke Carbis (@lukecarbis)
Author URI: http://carb.is
Contributors: Pete Nelson (@GunGeekATX)
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Kosher_Ipsum_API {

	function __construct() {
		add_action('posts_selection', array(&$this, 'api'));
	}

	function api() {

		if (is_page('api') && isset($_REQUEST['type'])) {

			require_once 'KosherIpsumGenerator.php';

			$generator = new KosherIpsumGenerator();
			$number_of_sentences = 0;
			$number_of_paragraphs = 5;

			if (isset($_REQUEST["paras"]))
				$number_of_paragraphs = intval($_REQUEST["paras"]);

			if (isset($_REQUEST["sentences"]))
				$number_of_sentences = intval($_REQUEST["sentences"]);

			$output = '';

			if ($number_of_paragraphs < 1)
				$number_of_paragraphs = 1;

			if ($number_of_paragraphs > 100)
				$number_of_paragraphs = 100;

			if ($number_of_sentences > 100)
				$number_of_sentences = 100;

			$start_with_lorem = isset($_REQUEST["start-with-lorem"]) && $_REQUEST["start-with-lorem"] == "1";

			$paras = $generator->make_some_kosher_filler(
				filter_var($_REQUEST["type"], FILTER_SANITIZE_STRING),
				$number_of_paragraphs,
				$start_with_lorem,
				$number_of_sentences);

			header('Access-Control-Allow-Origin: *');

			if (isset($_REQUEST["callback"])) {
				header("Content-Type: application/javascript");
				echo $_GET['callback'] . '(' . json_encode($paras) . ')';
			}
			else {
				header("Content-Type: application/json; charset=utf-8");
				echo json_encode($paras);
			}

			exit;

		}

	}

}


new Kosher_Ipsum_API();
