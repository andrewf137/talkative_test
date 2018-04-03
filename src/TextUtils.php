<?php declare(strict_types=1);

namespace Talkative;

class TextUtils
{
    /**
     * @var array $clean Cache processed string.
     */
    protected $clean = array();

    /**
     * Trims, removes line breaks, multiple spaces and generally cleans text
     * before processing.
     * @param   string|boolean  $strText      Text to be transformed
     * @return  string
     */
    public function cleanText(string $strText): string
    {
        // Check for boolean before processing as string
        if (is_bool($strText)) {
            return '';
        }

        // Check to see if we already processed this text. If we did, don't
        // re-process it.
        $key = sha1($strText);
        if (isset($clean[$key])) {
            return $clean[$key];
        }

        // Replace periods within numbers
        $strText = preg_replace('`([^0-9][0-9]+)\.([0-9]+[^0-9])`mis', '${1}0$2', $strText);

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
        $clean[$key] = $strText;
        return $strText;
    }

    /**
     * Gives string length. Tries mb_strlen and if that fails uses regular strlen.
     * @param   string  $strText      Text to be measured
     * @return  int
     */
    private function textLength(string $strText): int
    {
        $intTextLength = mb_strlen($strText, 'UTF-8');

        return $intTextLength;
    }

    /**
     * Returns word count for text.
     * @param   string  $strText      Text to be measured
     * @return  int
     */
    public function wordCount(string $strText): int
    {
        if (strlen(trim($strText)) == 0) {
            return 0;
        }

        // Will be tripped by em dashes with spaces either side, among other similar characters
        $intWords = 1 + $this->textLength(preg_replace('`[^ ]`', '', preg_replace('`\s+`', ' ', $strText))); // Space count + 1 is word count

        return $intWords;
    }

    public function getFileContent()
    {
        return null;
    }

}
