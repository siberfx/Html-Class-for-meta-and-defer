# HTML Class for Meta Tags, CSS files JS files and Defer CSS 

### Goals of this project:

- To make your web site fast loading, and prefetching dns for external sources
- teach people the basics of the OOP architecture
- promote the usage of OOP
- promote to comment code
- promote the usage of OOP code
- using only native PHP code, so people don't have to learn a framework

## Installation

Just upload the file where you keeping your class and function files, include it then call Class

```php

include "Html.class.php";
// call the Class 
$html = new Html();
```

# List of functions

```php
	public function doctype($type='html'){
        switch ($type) {
          case 'html': 
                echo "<!doctype html>" . "\n"; 
          break;
          case 'strict': 
                echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>" . "\n";
          break;
          case 'transitional': 
                echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
          break;
          case 'frameset': 
                echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">'; 
          break;
        } 
	  }


	public function https($var = false) {
		if($var === true) echo "<meta http-equiv='Content-Security-Policy' content='upgrade-insecure-requests'>". "\n";

	}

	public function favicon($file = 'favicon.png'){

	    echo "<link rel='shortcut icon' href='". $file ."' type='image/png' sizes='16x16'>" . "\n";

	}


	public function color() {
	    $str = '#';
	    for($i = 0 ; $i < 6 ; $i++) {
	      $randNum = rand(0 , 15);
	      switch ($randNum) {
	         case 10: $randNum = 'A'; break;
	         case 11: $randNum = 'B'; break;
	         case 12: $randNum = 'C'; break;
	         case 13: $randNum = 'D'; break;
	         case 14: $randNum = 'E'; break;
	         case 15: $randNum = 'F'; break;
	      }
	      $str .= $randNum;
	    }
	    return $str;
	  }



	/* Load Css files function example
	* 	$data = array(
	* 		"files/style"=>"css",
	* 		"files/style2"=>"css"
	* 	);
	*
	* loadCss ($data, true)
	* 
	 * if you will use page speed criteria, use true,
	 * but also you have to apply for the end of the page, LoadJs($data,true)
	*/

	public function loadCss($files = array(), $par = false) {

		echo ($par === true ? "\r\n".'<noscript>' . "\r\n" : '');

		$cnt = count($files);

		foreach($files as $file) {
			
			if (file_exists($file) ) {
				echo '<link src="'.$file.'" type="text/css" />' . "\r\n";
			}
		
		}

		echo ($par === true ? '</noscript>' . "\r\n" : '');

	}


	/* Load Css files function example
	* 	$data = array(
	* 		"files/style"=>"css",
	* 		"files/style2"=>"css"
	* 	);
	*
	* loadCss ($data, true)
	* 
	 * if you will use page speed criteria, use true,
	 * but also you have to apply for the end of the page, LoadJs($data,true)
	*/

	public function loadJs($files = array(), $par = false ) {

		$cnt = count($files);
		$ifTrue = '';
		$data = '';

		foreach($files as $file) {
			
			if (file_exists($file) ) {
				echo '<script src="'.$file.'" type="text/javascript"></script>' . "\r\n";
			} else {
				echo '<strong>'. $file . '</strong> not exist'."\r\n";
			}
		
		}

		if ($par === true) {
		 $i = 0;
		 foreach($cssfiles as $file) {

		 	if(file_exists($file)) {

				$data = '<script>' . "\r\n";
				$data .= 'var var'.$i.' = document.createElement("link");' . "\r\n";
				$data .= 'var'.$i.'.rel = "stylesheet";' . "\r\n";
				$data .= 'var'.$i.'.href = "'.$file.'";' . "\r\n";
				$data .= 'var'.$i.'.type = "text/css";' . "\r\n";
				$data .= 'var defer'.$i.' = document.getElementsByTagName("link")[0];' . "\r\n";
				$data .= 'defer'.$i.'.parentNode.insertBefore(var'.$i.', defer'.$i.');' . "\r\n";
				$data .= '</script>' . "\r\n";
		 	}
			$i++;

		}

		}
		return $data;


	}


	public function cssdefer( $files = array() ) {

		$cnt = count($files);
		$file = array_values($files);
		$data = '';

		 for ($i=0; $i < $cnt; $i++) {


				echo '<script>' . "\r\n";
				echo 'var var'.$i.' = document.createElement("link");' . "\r\n";
				echo 'var'.$i.'.rel = "stylesheet";' . "\r\n";
				echo 'var'.$i.'.href = "'.$file[$i].'";' . "\r\n";
				echo 'var'.$i.'.type = "text/css";' . "\r\n";
				echo 'var defer'.$i.' = document.getElementsByTagName("link")[0];' . "\r\n";
				echo 'defer'.$i.'.parentNode.insertBefore(var'.$i.', defer'.$i.');' . "\r\n";
				echo '</script>' . "\r\n";

		}


	}

	public function prefetch ($url = "") {
		if ($url != "") {
			echo '<link rel="dns-prefetch" href="'.$url.'">' . "\r\n";
		} else { 
			return false; 
		}
	}


	public function meta($data = array(), $og = false, $google = false ) {

		$jsonit = json_encode($data);
		$mt 	= json_decode($jsonit);

			echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />' . "\r\n";
			echo '<meta http-equiv="cache-control" content="'.$mt->cache.'">' . "\r\n";
			echo '<meta http-equiv="content-language" content="'.$mt->langcode.'">' . "\r\n";
			echo '<meta http-equiv="revisit-after" content="'.$mt->revisitafter.'">' . "\r\n";
			echo '<meta name="contact" content="'.$mt->email.'" />' . "\r\n";
			echo '<meta name="author" content="'.$mt->author.'" />' . "\r\n";
      		echo '<meta name="copyright" content="'.$mt->sitename.'">' . "\r\n";

		if($og === true) {
			echo '<!-- OG markup for Facebook and Google Plus -->' . "\r\n";
			echo '<meta property="og:locale" content="'.$mt->language.'" />' . "\r\n";
			echo '<meta property="og:type" content="'.$mt->type.'" />' . "\r\n";
			echo '<meta property="og:title" content="'.$mt->title.'" />' . "\r\n";
			echo '<meta property="og:description" content="'.$mt->desc.'" />' . "\r\n";
			echo '<meta property="og:url" content="'.$mt->url.'" />' . "\r\n";
			echo '<meta property="og:site_name" content="'.$mt->title.'" />' . "\r\n";
			echo '<meta property="og:image" content="'.$mt->image.'" />' . "\r\n";
		}

		if($google === true) {
			echo '<!-- Schema.org markup for Google+ -->' . "\r\n";
			echo '<meta itemprop="name" content="'.$mt->title.'">' . "\r\n";
			echo '<meta itemprop="description" content="'.$mt->desc.'">' . "\r\n";
			echo '<meta itemprop="image" content="'.$mt->image.'">' . "\r\n";

			echo '<meta name="googlebot" content="'.$mt->googlebot.'" />' . "\r\n";
			echo '<link href="'.$mt->gplus.'" rel="author" />' . "\r\n";
			echo '<meta name="Robots" content="'.$mt->robots.'" />' . "\r\n";
			echo '<meta name="rating" content="General" />' . "\r\n";
			echo '<meta name="distribution" content="global" />' . "\r\n";
		}
			echo '<link rel="canonical" href="'.$mt->url.'" />'. "\r\n";
	}


}
```
