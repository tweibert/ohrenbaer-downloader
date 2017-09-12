# ohrenbaer-downloader
A custom downloader for the rbb Ohrenbär podcast (German)

Dieses PHP-Script lädt alle verfügbaren Folgen des [Ohrenbär-Podcasts](https://www.ohrenbaer.de/podcast/podcast.html) des rbb herunter.

Die Dateien werden sinnvoll umbenannt, mit ID3v2-Tags versehen und in die entsprechenden Unterordner (einen pro Geschichte) einsortiert.

Bereits vorhandene Folgen werden erkannt, es werden also bei jedem Aufruf immer nur die neuen Folgen heruntergeladen.

## Voraussetzungen

  * PHP
  * cURL (als Kommandozeilentool)
  * ffmpeg (als Kommandozeilentool, für das Setzen der ID3v2-Tags)
  
## Verwendung

Einfach aufrufen:

    php ohrenbaer.php
    
Der Download erfolgt im aktuellen Ordner.

## Bekannte Probleme

Es werden nur Folgen heruntergeladen, bei denen die Beschreibung einem bestimmten Schema folgt ("Aus der OHRENBÄR-Radiogeschichte "xyz" (Folge i von n) von Max Mustermann. Es liest Klaus Donnerstag.").

Aktuell (September 2017) gibt es insgesamt 16 Folgen im Feed, bei denen die Beschreibung entweder komplett leer ist oder ausnahmsweise einem anderen Schema folgt (ARD-Themenwoche). Letzteres könnte durch eine intelligentere RegExp gelöst werden (to do).
