A repository for the kosher.im code

= What's in here? =

KosherIpsumGenerator.php - Contains the KosherIpsumGenerator class for generating kosher filler text.  For example:

	require_once 'KosherIpsumGenerator.php';
	$kosher_ipsum_generator = new KosherIpsumGenerator();
	$kashrut = $kosher_ipsum_generator->Make_Some_Kosher_Filler( 'kashrut-and-filler', 3, true );


kosher-ipsum-form.php - WordPress plugin for generating the form you see on our home page as well as processing the form and outputting kosher ipsum filler.

kosher-ipsum-api.php - WordPress plugin for our JSON API.

kosher-ipsum-oembed-provider.php - WordPress oEmbed provider

jquery-sample.html - Sample HTML/jQuery code for the jQuery plugin


Revision History

= May 23, 2014 =
* First release (forked from Bacon Ipsum https://github.com/petenelson/bacon-ipsum)

