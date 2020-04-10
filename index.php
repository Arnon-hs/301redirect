<?php
/**
 * Created by PhpStorm.
 * User: vasili
 * Date: 24/03/2020
 * Time: 22:20
 */
date_default_timezone_set("Europe/Moscow");
function readingFile($fileName)
{
    $fp = fopen($fileName, "r"); // Открываем файл в режиме чтения
    $mytext = array();
    if ($fp) {
        $index = 0;
        while (!feof($fp)) {
            $line = fgets($fp);
            $mytext[$index] = $line;
            $index++;
        }
    } else echo "Ошибка при открытии файла";
    fclose($fp);
    return $mytext;
}
function make301Redirects($from,$to, $out=false)
{
    // Redirect 301 /oldpage.html https://www.site.com/newpage.html
    $fileOutput = "output_".date("Y-m-d_H:i:s").".txt";
    $fp = fopen("$fileOutput", "a"); // Открываем файл в режиме записи
    foreach ($from as $index => $line){
        $link = trim(preg_replace('@^(?:https://)?([^/]+)@i','',$line));
        $enter = 'Redirect 301 '. $link .' '. trim($to[$index]) . "\n";
        $out = fwrite($fp, $enter); // Запись в файл
    }
    if ($out) echo "Данные в файл успешно занесены.\n";
    else echo 'Ошибка при записи в файл.';
    fclose($fp); //Закрытие файла
}
function delete_comments($from){
    $new=[];
    foreach($from as $line){
        if($line[0]=='#' || $line[0]==' ' || $line[0]=='' || $line[0]=="\n")
            continue;
//        if($line[strlen($line)]=="\n")

        $new[] = $line;
    }
    unset($from);
    return $new;
}
function writeOptimizeRedirect($from){
    $fileOutput = "beauty_".date("Y-m-d_H:i:s").".txt";
    $fp = fopen("$fileOutput", "a"); // Открываем файл в режиме записи
    foreach($from as $line){
        $out = fwrite($fp, $line);
    }
    if ($out) echo "Данные в файл успешно занесены.\n";
    else echo 'Ошибка при записи в файл.';
    unset($feom);
    return $out;
}
$inputFrom = readingFile('input.txt');
$inputTo = readingFile('inputTo.txt');
make301Redirects($inputFrom,$inputTo);
//$from = readingFile('.htaccess_new');
//$from = delete_comments($from);
//var_dump($from);
//writeOptimizeRedirect($from);
//make301Redirects($from,$inputTo);