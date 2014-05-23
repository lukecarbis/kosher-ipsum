<?php
/*
Class: Kosher Ipsum Generator
Author: Luke Carbis (@lukecarbis)
Author URI: http://carb.is
Contributors: Pete Nelson (@GunGeekATX)
Version: 1.0
*/

class KosherIpsumGenerator {

	function get_words( $type ) {
		$kashrut = array(
			'kosher',
			'kashrut',
			'halakha',
			'torah',
			'nevi\'im',
			'ketuvim',
			'tanakh',
			'haftarah',
			'talmud',
			'parashah',
			'haggadah',
			'rabbi',
			'rebbi',
			'tzaddik',
			'shabbat',
			'pesach',
			'sukkot',
			'shavuot',
			'yom teruah',
			'rosh hashana',
			'yom kippur',
			'chanukah',
			'purim',
			'challah',
			'matzah',
			'hamentaschen',
			'latke',
			'babka',
			'charoset',
			'lox',
			'sufganiyot',
			'tzimmes',
			'fazuelos',
			'maror',
			'karpas',
			'chazeret',
			'afikomen',
			'shema',
			'israel',
			'yerushalayim',
			'dreidel',
			'havdalah',
			'ketubah',
			'kippah',
			'kiddush',
			'menorah',
			'hanukkiah',
			'mezuzah',
			'megliot',
			'seder',
			'shofar',
			'tallit',
			'tefillin',
			'tzitzit',
			'tzedakah',
			'baruch',
			'shalom',
			'mitzvah',
			'erev',
			'megillah',
			'kibbutz',
			'simcha',
			'sameyach',
			'chag',
			'sukkah',
			'yeshiva',
			'chabad',
			'aliyah',
			'brit milah',
			'omer',
			'hallel',
			'mikveh',
			'b\'rachah',
			'l\'chayim',
		);
		$filler = array(
			'consectetur',
			'adipisicing',
			'elit',
			'sed',
			'do',
			'eiusmod',
			'tempor',
			'incididunt',
			'ut',
			'labore',
			'et',
			'dolore',
			'magna',
			'aliqua',
			'ut',
			'enim',
			'ad',
			'minim',
			'veniam',
			'quis',
			'nostrud',
			'exercitation',
			'ullamco',
			'laboris',
			'nisi',
			'ut',
			'aliquip',
			'ex',
			'ea',
			'commodo',
			'consequat',
			'duis',
			'aute',
			'irure',
			'dolor',
			'in',
			'reprehenderit',
			'in',
			'voluptate',
			'velit',
			'esse',
			'cillum',
			'dolore',
			'eu',
			'fugiat',
			'nulla',
			'pariatur',
			'excepteur',
			'sint',
			'occaecat',
			'cupidatat',
			'non',
			'proident',
			'sunt',
			'in',
			'culpa',
			'qui',
			'officia',
			'deserunt',
			'mollit',
			'anim',
			'id',
			'est',
			'laborum',
		);

		if ( 'kashrut-and-filler' === $type ) {
			$words = array_merge( $kashrut, $filler );
		} else {
			$words = $kashrut;
		}

		shuffle( $words );

		return $words;
	}


	function make_a_sentence( $type ) {
		// A sentence should be bewteen 4 and 15 words.
		$sentence = '';
		$length   = rand( 4, 15 );

		// Add a little more randomness to commas, about 2/3rds of the time
		$includeComma = $length >= 7 && rand( 0, 2 ) > 0;

		$words = $this->get_words( $type );

		if ( count( $words ) > 0 ) {
			// Capitalize the first word.
			$words[0] = ucfirst( $words[0] );

			for ( $i = 0; $i < $length; $i++ ) {

				if ( $i > 0 ) {
					if ( $i >= 3 && $i !== $length - 1 && $includeComma ) {
						if ( rand( 0, 1 ) === 1 ) {
							$sentence     = rtrim( $sentence ) . ', ';
							$includeComma = false;
						} else {
							$sentence .= ' ';
						}
					}
					else {
						$sentence .= ' ';
					}
				}

				$sentence .= $words[ $i ];
			}

			$sentence = rtrim( $sentence ) . '. ';
		}

		return $sentence;
	}

	public function make_a_paragraph( $type ) {
		// A paragraph should be bewteen 4 and 7 sentences.
		$paragraph = '';
		$length    = rand(4, 7);

		for ( $i = 0; $i < $length; $i++ ) {
			$paragraph .= $this->make_a_sentence( $type ) . ' ';
		}

		return rtrim( $paragraph );
	}

	public function make_some_kosher_filler( $type = 'kashrut-and-filler', $number_of_paragraphs = 5, $start_with_lorem = true, $number_of_sentences = 0 ) {
		$paragraphs = array();
		if ($number_of_sentences > 0) {
			$number_of_paragraphs = 1;
		}

		$words = '';

		for ( $i = 0; $i < $number_of_paragraphs; $i++ ) {
			if ( $number_of_sentences > 0 ) {
				for ( $s = 0; $s < $number_of_sentences; $s++ ) {
					$words .= $this->make_a_sentence( $type );
				}
			} else {
				$words = $this->make_a_paragraph( $type );
			}

			if ( $i === 0 && $start_with_lorem && count( $words ) > 0 ) {
				$words[0] = strtolower( $words[0] );
				$words    = 'Bacon ipsum dolor sit amet ' . $words;
			}

			$paragraphs[] = rtrim( $words );
		}

		return $paragraphs;
	}
}
