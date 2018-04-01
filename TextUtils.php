<?php

namespace Talkative;

class TextUtils
{
    /**
     * @var array $clean Cache processed string.
     */
    protected static $clean = array();

    /**
     * Trims, removes line breaks, multiple spaces and generally cleans text
     * before processing.
     * @param   string|boolean  $strText      Text to be transformed
     * @return  string
     */
    public static function cleanText(string $strText): string
    {
        // Check for boolean before processing as string
        if (is_bool($strText)) {
            return '';
        }

        // Check to see if we already processed this text. If we did, don't
        // re-process it.
        $key = sha1($strText);
        if (isset(self::$clean[$key])) {
            return self::$clean[$key];
        }

        // ISO-8859-15 and non UTF-8: \x89 \x80 \xf7
        // $strText = $strText."\x89\x80\xf7";
        // echo($strText."\n");
        // echo(strlen($strText)."\n");
        // echo(mb_strlen($strText)."\n");
        // echo (self::detectUTF8($strText)."\n");
        // mb_detect_order('ASCII, UTF-8, ISO-8859-15');
        // echo implode(", ", mb_list_encodings());
        // echo ('Codification: ' . mb_detect_encoding($strText, 'ASCII', true) . "\n");
        // echo implode(", ", mb_detect_order());

        // Replace periods within numbers
        $strText = preg_replace('`([^0-9][0-9]+)\.([0-9]+[^0-9])`mis', '${1}0$2', $strText);

        // Handle HTML. Treat block level elements as sentence terminators and
        // remove all other tags.
        // $strText = preg_replace('`<script(.*?)>(.*?)</script>`is', '', $strText);
        // $strText = preg_replace('`\</?(address|blockquote|center|dir|div|dl|dd|dt|fieldset|form|h1|h2|h3|h4|h5|h6|menu|noscript|ol|p|pre|table|ul|li)[^>]*>`is', '.', $strText);
        // $strText = html_entity_decode($strText);
        // $strText = strip_tags($strText);

        // Assume blank lines (i.e., paragraph breaks) end sentences (useful
        // for titles in plain text documents) and replace remaining new
        // lines with spaces
        $strText = preg_replace('`(\r\n|\n\r)`is', "\n", $strText);
        $strText = preg_replace('`(\r|\n){2,}`is', ".\n\n", $strText);
        $strText = preg_replace('`[ ]*(\n|\r\n|\r)[ ]*`', ' ', $strText);

        // Replace commas, hyphens, quotes etc (count as spaces)
        $strText = preg_replace('`[",:;(){}/\`-]`', ' ', $strText);

        // Unify terminators and spaces
        $strText = trim($strText, '. ') . '.'; // Add final terminator.
        $strText = preg_replace('`[\.!?]`', '.', $strText); // Unify terminators
        $strText = preg_replace('`([\.\s]*\.[\.\s]*)`mis', '. ', $strText); // Merge terminators separated by whitespace.
        $strText = preg_replace('`[ ]+`', ' ', $strText); // Remove multiple spaces
        $strText = preg_replace('`([\.])[\. ]+`', '$1', $strText); // Check for duplicated terminators
        $strText = trim(preg_replace('`[ ]*([\.])`', '$1 ', $strText)); // Pad sentence terminators

        $strText = trim($strText);

        // Cache it and return
        self::$clean[$key] = $strText;
        return $strText;
    }

    // public static function detectUTF8($string)
    // {
    //         return preg_match('%(?:
    //         [\xC2-\xDF][\x80-\xBF]
    //         |\xE0[\xA0-\xBF][\x80-\xBF]
    //         |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
    //         |\xED[\x80-\x9F][\x80-\xBF]
    //         |\xF0[\x90-\xBF][\x80-\xBF]{2}
    //         |[\xF1-\xF3][\x80-\xBF]{3}
    //         |\xF4[\x80-\x8F][\x80-\xBF]{2}
    //         )+%xs', $string);
    // }

    /**
     * Gives string length. Tries mb_strlen and if that fails uses regular strlen.
     * @param   string  $strText      Text to be measured
     * @return  int
     */
    public static function textLength(string $strText): int
    {
        // If no double byte characters, use strlen, which is much faster than mb_strlen
        // if (mb_detect_encoding($strText, 'ASCII', true)) {
        //     echo "ASCII\n";
        //     $intTextLength = strlen($strText);
        // } else {
        //     echo "UTF-8\n";
        //     $intTextLength = mb_strlen($strText, mb_detect_encoding($strText, implode(", ", mb_list_encodings()), true));
        // }

        // $intTextLength = mb_strlen($strText, mb_detect_encoding($strText, implode(", ", mb_list_encodings()), true));
        $intTextLength = mb_strlen($strText, 'UTF-8');

        return $intTextLength;
    }

    /**
     * Returns word count for text.
     * @param   string  $strText      Text to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int
     */
    public static function wordCount(string $strText, ?string $strEncoding): int
    {
        if (strlen(trim($strText)) == 0) {
            return 0;
        }

        // Will be tripped by em dashes with spaces either side, among other similar characters
        $intWords = 1 + self::textLength(preg_replace('`[^ ]`', '', preg_replace('`\s+`', ' ', $strText)), $strEncoding); // Space count + 1 is word count

        return $intWords;
    }

}
