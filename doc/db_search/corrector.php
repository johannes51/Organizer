<?php

function movieLookie($movie, $year)
{
  $movieName = str_replace(' ', '+', $movie);

  $page = @file_get_contents( 'http://www.imdb.com/find?s=tt&q='. $movieName. ' ('.$year.')');
  if(@preg_match_all('~<p style="margin:0 0 0.5em 0;"><b>Media from .*?href="/title\/(.*?)".*?</p>~s', $page, $matches)) {     
   return $matches;
  }
  else if(@preg_match_all('~<td class="result_text">.*?href="/title\/(.*?)".*?</td>~s', $page, $matches)) {
   //header('Location: http://www.imdb.com/title/'. $matches[1].''); 
    return $matches;
  }
  else {
   return false;
  }
}



echo '<?xml version="1.0" encoding="utf-8" ?>';

$action = filter_input(INPUT_GET, 'action');
$id = filter_input(INPUT_GET, 'id');
$imdb_id = filter_input(INPUT_GET, 'imdb_id');
$movie = filter_input(INPUT_GET, 'movie');

$mysql = new mysqli("johannas.ddns.net", "phpuser", "1234", "Life");
$mysql->set_charset("utf8");
$mysql->query("SET NAMES 'utf8'");


if (NULL == $action) { $action = "phase1"; }

 switch ($action) {
   case "phase1":
     if (NULL == $id)
     {
       $query = "SELECT * From Filme WHERE Komplett LIKE \"0\" AND `IMDB-id` LIKE \"\" ORDER BY RAND() LIMIT 1";
     }
     else
     {
       $query = "SELECT * From Filme WHERE id LIKE \"$id\"";
     }
      $result = $mysql->query($query);
      
      echo $mysql->error;
      
      if ($result->num_rows === 0)
      {echo "<a href=\"/content_creator.php?app=corrector&action=phase3\">phase3</a>";}
      
      $res_row = $result->fetch_assoc();
      echo $res_row["Pfad"];
      echo "<br>";
      $id = $res_row["id"];
      
      
        ?><br>File:
  <a href="<?php echo "vlc://".$res_row['Pfad']."/".$res_row['Dateiname'] ?>">
            <?php echo str_replace(".", " ", $res_row['Name']) ?>
          </a>
<br><br>
  <?php
      
      
      if ($movie == NULL) { $movie = str_replace(".", " ", substr($res_row['Pfad'], strrpos($res_row['Pfad'], "/") + 1)); }
      $year = "";
      
      $matches = movieLookie($movie, $year);
      
      if (FALSE !== $matches)
      {
        for ($i = 0;$i<count($matches[0]);$i++)
        {
          $matches[0][$i] = substr_replace($matches[0][$i], "http://imdb.com", strpos($matches[0][$i], "href=\"") + 6, 0);
          echo "<br>IMDB: " . $matches[0][$i];

          $imdb_id = substr($matches[1][$i], 0, 9);
          echo "<br><br>"
          . "<a href=\"/content_creator.php?app=corrector&action=phase2&id=$id&imdb_id=$imdb_id\">Jo</a>"
                  . "<br><br>";
        }
        echo "<br><a href=\"/content_creator.php?app=corrector&action=phase1&id=$id&movie=agfsfgs\">Na</a>";
        echo "<br><a href=\"/content_creator.php?app=corrector&action=phase1\">Next!</a>";
      }
      else
        { ?>
        <form action="content_creator.php?app=corrector&action=phase1" method="GET">
  <fieldset style="width: 45%; float: left">
    <legend>Suchstring</legend>
      <input type="search" name="movie" id="movie" 
        <?php echo 'value="' . $movie . '" ' ?> style="width: 500px"/>
    </div>
  </fieldset>
          <input type="hidden" name="app" value="corrector" />
          <input type="hidden" name="action" value="phase1" />
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
  <button>Submit</button> 
    </form>
  <?php  
      }
     break;

   case "phase2":
     if (NULL != $id && NULL != $imdb_id)
     {
       $query = "UPDATE `Filme` SET `IMDB-id` = '$imdb_id' WHERE `id` = $id";
       $result = $mysql->query($query);
     }
     echo "<a href=\"/content_creator.php?app=corrector&action=phase1\">Jo</a>";
      ?><script language="javascript" type="text/javascript">
     window.setTimeout('window.location="/content_creator.php?app=corrector&action=phase1"',500);
 </script><?php
     break;
     
     
   case "phase3":
     if (is_numeric($id))
     
        {$query = "Update Filme set Komplett='1' WHERE id=$id";
        echo $query;
     $res = $mysql->query($query);
       
     }
     
     $query = "SELECT * From Filme WHERE Komplett LIKE \"0\" AND `Sprachen` LIKE \"eng\" ORDER BY RAND() LIMIT 1";
     $res = $mysql->query($query);
     
     foreach ($res as $key => $value)
     {
       ?><br>File:
  <a href="<?php echo "vlc://".$value['Pfad']."/".$value['Dateiname'] ?>">
            <?php echo str_replace(".", " ", $value['Name']) ?>
          </a>
<br><br><?php
       print_r($value);
       ?>
<a href="index.php?app=corrector&action=phase3&id=<?php echo $value['id']?>">Ja</a>
<a href="index.php?app=corrector&action=phase3">Na</a>
<?php     }
   
   default:
     break;
}