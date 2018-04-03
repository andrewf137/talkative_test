<?php declare(strict_types=1);
// Developed under php 7.2
namespace Talkative;

require_once(__DIR__.'\\vendor\\autoload.php');
// require_once(__DIR__.'\\src\\TextStatistics.php');
// require_once(__DIR__.'\\src\\TextUtils.php');
// require_once(__DIR__.'\\src\\TextSource.php');
/**
 * Run the following commands to execute from command line:
 *
 * >php index.php 10 20
 * >php index.php -1 -25
 * >php index.php 12 anythingelse
 */
// if (php_sapi_name() === 'cli') {
//     $int1 = $argv[1] ?? null;
//     $int2 = $argv[2] ?? null;
//     try {
//         $obj = new OutputIntegersList();
//         $obj->validateArgs($int1, $int2);
//         echo $obj->buildIntegersList();
//     } catch(\Exception $e) {
//         echo 'Error: ' .$e->getMessage();
//     }
// }

$textSource = new TextSource('input4.txt');
$obj = new TextStatistics($textSource);
echo ($obj->wordCount());
// die();
// $fileName = 'input.txt';
// $file = fopen( $fileName, "r" );
// if( $file == false ) {
//     echo ( "Error in opening file" );
//     exit();
//  }
//  $fileSize = filesize( $fileName );
//  $fileText = fread( $file, $fileSize );
//  fclose( $file );

// $obj = new \Talkative\TextStatistics();
// for ($i=1; $i <= 100; $i++) {
    // $numOfWords = $obj->wordCount($fileText);
// }
// $numOfChars = $obj->characterCount($fileText);

//  echo ( "File size : $filesize bytes" );
//  echo "\n";
//  echo ( "<pre>$filetext</pre>" );
// echo ("No of words:" . $numOfWords . "\n");
// echo ("No of characters:" . $numOfChars . "\n");
// echo (TextUtils::cleanText('MaÃ±ana toca programaciÃ³n')."\n");
// echo (TextUtils::cleanText('áéíóúàèìòùÁÉÍÓÚÀÈÌÒÙ')."\n");
// echo \mb_internal_encoding();

// Composed words as god-war are counted as two.

// Divide text into segments with space as segment separator.
// If a segment has no letter or no number, the segment count as cero
// If
