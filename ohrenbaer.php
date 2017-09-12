<?php

function sanitize($fn) {
  return str_replace(array("?", ",", ":"), '', $fn);
}

$xml = simplexml_load_file('https://www.ohrenbaer.de/podcast/podcast.xml/feed=podcast.xml');


foreach ($xml->channel[0]->item as $item) {
  $desc = trim($item->description);
  $url = trim($item->link);
  
  if (! preg_match("/^Aus der .*Radiogeschichte(\: (.*)| \"(.*?)\")\s?\(Folge (\d+) von (\d+)\) von (.*)\. Es liest: (.*)\./", $desc, $m)) {
    print "Fehler beim Parsen der Beschreibung für $url: $desc\n";
    continue;
  }
  
  $titel = trim($item->title);
  $geschichte = trim($m[2] ? $m[2] : $m[3]);
  $folge = $m[4];
  $folgevon = $m[5];
  $autor = $m[6];
  $sprecher = $m[7];
  
  $dir = sanitize($geschichte);
  
  $fn = $dir . "/" . sprintf("%02d - %s.mp3", $folge, sanitize($titel));
  
  if (file_exists($fn)) {
    continue;
  }
  
  print "$fn\n";
  
  system("mkdir -p \"$dir\"");
  system("curl -s -o temp.mp3 \"$url\"");
  system("ffmpeg -y -loglevel error -i temp.mp3 -metadata title=\"$titel\" -metadata album=\"$geschichte\" -metadata artist=\"$autor\" -metadata track=\"$folge\" -codec copy \"$fn\"");
  system("rm temp.mp3");
}
