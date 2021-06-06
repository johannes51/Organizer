<?php
function _movieRedirect($movie, $year)
{
  $movieName = str_replace(' ', '+', $movie);

  $page = @file_get_contents( 'http://www.imdb.com/find?s=all&q='. $movieName. ' ('.$year.')');
  if(@preg_match('~<p style="margin:0 0 0.5em 0;"><b>Media from .*?href="/title\/(.*?)".*?</p>~s', $page, $matches)) {     
   header('Location: http://www.imdb.com/title/'. $matches[1]. '');
   exit();   
  }
  else if(@preg_match('~<td class="result_text">.*?href="/title\/(.*?)".*?</td>~s', $page, $matches)) {
   header('Location: http://www.imdb.com/title/'. $matches[1].''); 
   exit();
  }
  else {
   return false;
  }
}
?>
