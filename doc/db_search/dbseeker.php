<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require __DIR__ . '/vendor/autoload.php';
use Mhor\MediaInfo\MediaInfo;

$validFileList = [];

$Directory = new RecursiveDirectoryIterator(
'/media/jo/NAS/Media/Filme/Comic/Marvels.The.Avengers.2.Age.of.Ultron.2015.GERMAN.DTS.DL.720p.BluRay.x264-WodkaE/'
);
$Iterator = new RecursiveIteratorIterator($Directory);

foreach ($Iterator as $filename => $object) {
    if ($object->getSize() >= 100000000) {
        try {
            $info =  MediaInfo::getInfo($object);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo "\nfilename: ".$object."\n";
            echo $exc->getMessage()."\n";
            continue;
        }
        
        if (null == $info->getGeneral()) {
            echo "Keine info für $object\n";
            continue;
        }
        
        if (null == $info->getVideos()) {
            echo "Keine video für $object\n";
            continue;
        }
        
        $mysqli = new mysqli("nas", "phpuser", "1234", "Life");
        
        $m_name = $mysqli->real_escape_string(
                $info->getGeneral()->get("file_name"));
        
        $m_container = $mysqli->real_escape_string(
                $info->getGeneral()->get("commercial_name"));
        
        $a_languages = explode("/",
                $info->getGeneral()->get("audio_language_list"));
        $a_languages_sqlform = [];
        foreach ($a_languages as $string) {
            if (preg_match("/ger/", $string) |
                    preg_match("/Ger/", $string) |
                    preg_match("/deu/", $string) |
                    preg_match("/Deu/", $string)) {
                $a_languages_sqlform[] = "ger";
            }
            else if (preg_match("/eng/", $string) |
                    preg_match("/Eng/", $string)) {
                $a_languages_sqlform[] = "eng";
            }
            else if (preg_match("/jap/", $string) |
                    preg_match("/Jap/", $string)) {
                $a_languages_sqlform[] = "jap";
            }
            else if (preg_match("/fra/", $string) |
                    preg_match("/Fra/", $string) |
                    preg_match("/fre/", $string) |
                    preg_match("/Fre/", $string)) {
                $a_languages_sqlform[] = "fra";
            }
            else if (preg_match("/\w/", $string))
            {
                $a_languages_sqlform[] = "other";
            }
        }
        $m_languages = implode(",", $a_languages_sqlform);
        
        $m_folder_name = $mysqli->real_escape_string(
                $info->getGeneral()->get("folder_name"));
        
        if (preg_match("/Anime/", $m_folder_name)) {
            $m_genre = "Anime";
        }
        else if (preg_match("/Action/", $m_folder_name)) {
            $m_genre = "Action";
        }
        else if (preg_match("/Comedy/", $m_folder_name)) {
            $m_genre = "Comedy";
        }
        else if (preg_match("/Comic/", $m_folder_name)) {
            $m_genre = "Comicverfilmung";
        }
        else if (preg_match("/Drama/", $m_folder_name)) {
            $m_genre = "Drama";
        }
        else if (preg_match("/Drogen/", $m_folder_name)) {
            $m_genre = "Drogen";
        }
        else if (preg_match("/Fantasy/", $m_folder_name)) {
            $m_genre = "Fantasy";
        }
        else if (preg_match("/Horror/", $m_folder_name)) {
            $m_genre = "Horror";
        }
        else if (preg_match("/SciFi/", $m_folder_name)) {
            $m_genre = "Scifi";
        }
        else if (preg_match("/Thriller/", $m_folder_name)) {
            $m_genre = "Thriller";
        }
        else {
            $m_genre = "";
        }
        
        $m_file_name = $mysqli->real_escape_string(
                $info->getGeneral()->get("file_name") . "." .
                $info->getGeneral()->get("file_extension"));
        
        $duration_ms = 0;
        if (null !== $info->getGeneral()->get("duration")) {
            $duration_ms = $mysqli->real_escape_string(
                $info->getGeneral()->get("duration")->getMilliseconds());
        }
        if ($duration_ms == 0 & null !== $info->getVideos()[0]->get("duration")) {
            $duration_ms = $mysqli->real_escape_string(
                $info->getVideos()[0]->get("duration")->getMilliseconds());
        }
        if ($duration_ms == 0 & null !== $info->getAudios()[0]->get("duration")) {
            $duration_ms = $mysqli->real_escape_string(
                $info->getAudios()[0]->get("duration")->getMilliseconds());
        }
        if ($duration_ms == 0) {
            echo "No duration for: $object\n";
        }
        $m_duration = floor($duration_ms / 3600000) . ":"
                . floor(($duration_ms % 3600000) / 60000) . ":"
                . floor(($duration_ms % 60000) / 1000);
        $m_codec = $mysqli->real_escape_string(
                $info->getVideos()[0]->get("commercial_name") . "/"
                . $info->getVideos()[0]->get("writing_library_name"));
        $m_resolution = $mysqli->real_escape_string(
                $info->getVideos()[0]->get("height")->getAbsoluteValue());
        
        if (preg_match("/Geseh/", $m_folder_name)) {
            $m_seen = 1;
        }
        else
        {
            $m_seen = 0;
        }
        
        $matches = [];
        preg_match_all("/\d\d\d\d/",
                $info->getGeneral()->get("complete_name"), $matches);
        
        $m_year = "";
        foreach ($matches as $value)
        {
            if (isset($value[0])) {
                if ($value[0] >= 1890 & $value[0] <= 2100) {
                    $m_year = $value[0];
                }
            }
        }
        
        $sql_string = "INSERT INTO `Filme` "
                . "(`Name`, `Jahr`, `Genres`, `Sprachen`, `Dauer`, "
                . "`Aufloesung`, `Container`, `Codec`, `Dateiname`, `Pfad`, "
                . "`Gesehen`) "
                . "VALUES ('$m_name', '$m_year', '$m_genre', '$m_languages', "
                . "'$m_duration', '$m_resolution', '$m_container', '$m_codec', "
                . "'$m_file_name', '$m_folder_name', '$m_seen');";
        $mysqli->query("SET NAMES 'utf8'");
        //$res = $mysqli->query($sql_string);
        echo $sql_string;
        if ($mysqli->errno !== 0)
        {
            echo "errno: ".$mysqli->errno." error: ".$mysqli->error."\n";
            echo "-----------\n"
		.$sql_string."\n"
		."-----------\n\n";
        }
    }
}
