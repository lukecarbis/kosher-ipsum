<?php
/*
Plugin Name: Kosher Ipsum - Generator Form
Description: Creates the input form for generating kosher ipsum
Plugin URI: https://github.com/lukecarbis/kosher-ipsum
Version: 1.0
Author: Luke Carbis
Author URI: http://carb.is
Contributors: Pete Nelson (@GunGeekATX)
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('kosher-ipsum-form', 'kosher_ipsum_form');

function kosher_ipsum_form($atts) {
	$output = '';

	$form = '
		<p>Does your lorem ipsum text need a little less latin and a little more Hebrew? Give our generator a try... it’s kosher!</p>

		<form id="make-it-kosher" action="' . site_url('/') . '" method="get">
			<table>
				<tbody>
				<tr>
					<td>Paragraphs:</td>
					<td><input style="width: 40px;" type="text" name="paras" value="5" maxlength="2" /></td>
				</tr>
				<tr>
					<td>Type:</td>
					<td><input id="all-kashrut" type="radio" name="type" value="all-kashrut" checked="checked" /><label for="all-kashrut">All Kashrut</label> <input id="kashrut-and-filler" type="radio" name="type" value="kashrut-and-filler" /><label for="kashrut-and-filler">Kashrut and Filler</label></td>
				</tr>
				<tr>
					<td></td>
					<td><input id="start-with-lorem" type="checkbox" name="start-with-lorem" value="1" checked="checked" /> <label for="start-with-lorem">Start with \'Kosher ipsum dolor sit amet...\'</label></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Challah Me" /></td>
				</tr>
				</tbody>
				</table>
		</form>
	';


	if (isset($_REQUEST["type"])) {

		require_once 'KosherIpsumGenerator.php';

		$generator = new KosherIpsumGenerator();
		$number_of_paragraphs = 5;
		if (isset($_REQUEST["paras"]))
			$number_of_paragraphs = intval($_REQUEST["paras"]);

		$output = '';

		if ($number_of_paragraphs < 1)
			$number_of_paragraphs = 1;

		if ($number_of_paragraphs > 100)
			$number_of_paragraphs = 100;

		$paragraphs = $generator->make_some_kosher_filler(
			$_REQUEST["type"],
			$number_of_paragraphs,
			isset($_REQUEST["start-with-lorem"]) && $_REQUEST["start-with-lorem"] == "1");


		$output = '<div>';
		foreach($paragraphs as $paragraph)
			$output .= '<p>' . $paragraph . '</p>';

		$output .= '</div>';
	}

	return $output . $form;
}

