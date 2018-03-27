<?php
// we define where the asset files are
define ("cdn", "http://example.com/url/for/assets/");
//including the function file
include "function/Html.class.php";
// calling the class
$so = new Html();

// collecting the css files data in array
$cssdata = array(
	cdn . "style.css",
	cdn . "style2.css",
	cdn . "bootstrap.min.css"
);
// collecting the js files data in array
$jsdata = array(
	cdn . "bootstrap.min.js",
	cdn . "main.js"
);
// collecting the Meta Tags data in array
$metadata 	= array(
"langcode" 		=> "en",
"language" 		=> "en-US",
"title" 		=> "Page Title",
"content" 		=> "width=device-width, initial-scale=1.0",
"keys" 			=> "siberfx, web, developer, keywords",
"desc" 			=> "Page description which search engines required",
"email" 		=> "info@siberfx.com",
"url" 			=> "http://example.com/",
"image" 		=> cdn . "logo.png",
"type" 			=> "article",
"revisitafter"  => "7 days",
"cache" 		=> "public",
"googlebot" 	=> "All, Index, Follow",
"robots" 		=> "All, Index, Follow",
"author" 		=> "Selim GORMUS",
"gplus" 		=> "https://plus.google.com/u/0/100045195022614449534",
"sitename"		=> "SiberFx Creative Solutions"
);


$so->doctype("html");
echo '<title>Page Title </title>' . "\r\n";
echo '<head> ';

//calling favicon file, for PNG.
$so->favicon(cdn . "favicon.png");
// prefetching DNS for page speed
$so->prefetch("//fonts.googleapis.com", true);

// gathering meta tags data and 
$so->meta($metadata, true, true);

echo '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto&amp;subset=latin-ext">';
// Gathering CSS files
$so->loadCss($cssdata, true);
// if your server has HTTPS, we set this option as true for google tag appears.
$so->https(false);

echo '</head> ';
echo '<body style="background-color:'.$so->color().'" > ';





// page footer area.
echo '<footer> ';
// footer
// to defer css files we set this option.
$so->cssdefer($cssdata);
// gathering JS files
$so->loadJs( $jsdata );
echo '</footer> ';
?>

<script>
// ... for additional javascript or jQuery :)
</script>

<?php
echo '</body> ';
echo '</html>';
