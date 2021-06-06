<?php

$mysql = new mysqli("johannas.ddns.net", "phpuser", "1234", "Life");
$mysql->set_charset("utf8");

$res = $mysql->query("select `IMDB-id`, `id` from Filme where Regie=''");

foreach ($res as $key => $value)
{
  $response = file_get_contents("http://www.omdbapi.com/?i=" . $value['IMDB-id']);
  $imdb = json_decode($response);
  $q = "update Filme set "
          . "Name='".$mysql->real_escape_string($imdb->Title)."',"
          . "Regie='".$mysql->real_escape_string($imdb->Director)."',"
          . "Genre='".$mysql->real_escape_string($imdb->Genre)."', "
          . "Jahr=".$mysql->real_escape_string($imdb->Year)
          . " where id=".$value['id'];
  if ($imdb->Response == 'True') 
  {
    echo $q;
    $mysql->query($q);
  }
  else { 
    echo "Na!";
    print_r($imdb);
    echo "ID: ".$value['id'];
  }
}