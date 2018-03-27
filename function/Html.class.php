<?php

Class Html {


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
  *   $data = array(
  *     "files/style"=>"css",
  *     "files/style2"=>"css"
  *   );
  *
  * loadCss ($data, true)
  * 
   * if you will use page speed criteria, use true,
   * but also you have to apply for the end of the page, LoadJs($data,true)
  */

  public function loadCss(&$files = array(), $par = false) {

    echo ($par === true ? '<noscript>' . "\r\n" : '');

    foreach($files as $file) {
       echo '<link src="'.$file.'" type="text/css" />' . "\r\n";
    }

    echo ($par === true ? '</noscript>' . "\r\n" : '');

  }


  /* Load Css files function example
  *   $data = array(
  *     "files/style"=>"css",
  *     "files/style2"=>"css"
  *   );
  *
  * loadCss ($data, true)
  * 
   * if you will use page speed criteria, use true,
   * but also you have to apply for the end of the page, LoadJs($data,true)
  */

  public function loadJs($files = array(), $par = false ) {

    $ifTrue = '';
    $data = '';

    foreach($files as $file) {
        echo '<script src="'.$file.'" type="text/javascript"></script>' . "\r\n";
    }

    if ($par === true) {
     $i = 0;
     foreach($cssfiles as $file) {

        $data = '<script>' . "\r\n";
        $data .= 'var var'.$i.' = document.createElement("link");' . "\r\n";
        $data .= 'var'.$i.'.rel = "stylesheet";' . "\r\n";
        $data .= 'var'.$i.'.href = "'.$file.'";' . "\r\n";
        $data .= 'var'.$i.'.type = "text/css";' . "\r\n";
        $data .= 'var defer'.$i.' = document.getElementsByTagName("link")[0];' . "\r\n";
        $data .= 'defer'.$i.'.parentNode.insertBefore(var'.$i.', defer'.$i.');' . "\r\n";
        $data .= '</script>' . "\r\n";
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


  public function meta($data = array(), $og = false, $google = false, $compressed = false ) {

    $jsonit = json_encode($data);
    $mt     = json_decode($jsonit);
    $enter  = ($compressed === true ? "\r\n" : "" );

      echo '  <meta content="'.$mt->content.'" name="viewport">' . $enter;
      echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />' . $enter;
      echo '<meta http-equiv="cache-control" content="'.$mt->cache.'">' . $enter;
      echo '<meta http-equiv="content-language" content="'.$mt->langcode.'">' . $enter;
      echo '<meta http-equiv="revisit-after" content="'.$mt->revisitafter.'">' . $enter;
      echo '<meta name="contact" content="'.$mt->email.'" />' . $enter;
      echo '<meta name="author" content="'.$mt->author.'" />' . $enter;
      echo '<meta name="copyright" content="'.$mt->sitename.'">' . $enter;

    if($og === true) {
      echo '<!-- OG markup for Facebook and Google Plus -->' . $enter;
      echo '<meta property="og:locale" content="'.$mt->language.'" />' . $enter;
      echo '<meta property="og:type" content="'.$mt->type.'" />' . $enter;
      echo '<meta property="og:title" content="'.$mt->title.'" />' . $enter;
      echo '<meta property="og:description" content="'.$mt->desc.'" />' . $enter;
      echo '<meta property="og:url" content="'.$mt->url.'" />' . $enter;
      echo '<meta property="og:site_name" content="'.$mt->title.'" />' . $enter;
      echo '<meta property="og:image" content="'.$mt->image.'" />' . $enter;
    }

    if($google === true) {
      echo '<!-- Schema.org markup for Google+ -->' . $enter;
      echo '<meta itemprop="name" content="'.$mt->title.'">' . $enter;
      echo '<meta itemprop="description" content="'.$mt->desc.'">' . $enter;
      echo '<meta itemprop="image" content="'.$mt->image.'">' . $enter;

      echo '<meta name="googlebot" content="'.$mt->googlebot.'" />' . $enter;
      echo '<link href="'.$mt->gplus.'" rel="author" />' . $enter;
      echo '<meta name="Robots" content="'.$mt->robots.'" />' . $enter;
      echo '<meta name="rating" content="General" />' . $enter;
      echo '<meta name="distribution" content="global" />' . $enter;
    }
      echo '<link rel="canonical" href="'.$mt->url.'" />'. $enter;
  }


}
