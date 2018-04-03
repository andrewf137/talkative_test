<?php declare(strict_types=1);

namespace Talkative;

class TextStatistics
{
    public const MSG_INVALID_FILE_NAME = 'Invalid file name "%s"';

    /**
     * @var string $strText Holds the last text checked. If no text passed to
     * function, it will use this text instead.
     */
    private $fileName;

    /**
     * Constructor.
     *
     * @param  string  $strEncoding Optional character encoding.
     * @return void
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Get file path from file name.
     *
     * @return string
     * @throws WrongFileNameException if name file invalid or doesn't exist.
     */

    public function getTextSource(): string
    {
        if (substr($this->fileName, 0, 8) === 'sources/' ||
            substr($this->fileName, 0, 9) === '/sources/' ||
            substr($this->fileName, 0, 8) === 'sources\\' ||
            substr($this->fileName, 0, 9) === '\\sources\\'
            ) {
            $filePath = realpath(__DIR__.'/../'.$this->fileName);
        } else {
            $filePath = realpath(__DIR__.'/../sources/'.$this->fileName);
        }

        if (!$filePath || !file_exists($filePath)) {
            throw new WrongFileNameException(sprintf(static::MSG_INVALID_FILE_NAME, $this->fileName));
        }

        return file_get_contents($filePath);
            // $file = fopen($filePath, 'r');
            // $fileSize = filesize($filePath);
            // $fileContent = fread($file, $fileSize);
            // fclose( $file );
    }

    /**
     * Trims, removes line breaks, multiple spaces and generally cleans text
     * before processing.
     * @param   string|boolean  $strText      Text to be transformed
     * @return  string
     */
    public function cleanText(string $strText): string
    {
        // Check for boolean before processing as string
        // if (is_bool($strText)) {
        //     return '';
        // }

        // Check to see if we already processed this text. If we did, don't
        // re-process it.
        $key = sha1($strText);
        if (isset($clean[$key])) {
            return $clean[$key];
        }

        // Replace periods within numbers
        $strText = preg_replace('`([^0-9][0-9]+)\.([0-9]+[^0-9])`mis', '${1}0$2', $strText);
        // echo 'replace 1: '.$strText."\n";

        // Assume blank lines (i.e., paragraph breaks) end sentences (useful
        // for titles in plain text documents) and replace remaining new
        // lines with spaces
        $strText = preg_replace('`(\r\n|\n\r)`is', "\n", $strText);
        // echo 'replace 2: '.$strText."\n";
        $strText = preg_replace('`(\r|\n){2,}`is', ".\n\n", $strText);
        // echo 'replace 3: '.$strText."\n";
        $strText = preg_replace('`[ ]*(\n|\r\n|\r)[ ]*`', ' ', $strText);
        // echo 'replace 4: '.$strText."\n";

        // Replace commas, hyphens, quotes etc (count as spaces)
        $strText = preg_replace('`[",:;(){}/\`-]`', ' ', $strText);
        // echo 'replace 5: '.$strText."\n";

        // Unify terminators and spaces
        // $strText = trim($strText, '. ') . '.'; // Add final terminator.
        // echo 'replace 6: '.$strText."\n";
        $strText = preg_replace('`[\.!?]`', '.', $strText); // Unify terminators
        // echo 'replace 7: '.$strText."\n";
        $strText = preg_replace('`([\.\s]*\.[\.\s]*)`mis', '. ', $strText); // Merge terminators separated by whitespace.
        // echo 'replace 8: '.$strText."\n";
        $strText = preg_replace('`[ ]+`', ' ', $strText); // Remove multiple spaces
        // echo 'replace 9: '.$strText."\n";
        $strText = preg_replace('`([\.])[\. ]+`', '$1', $strText); // Check for duplicated terminators
        // echo 'replace 10: '.$strText."\n";
        $strText = trim(preg_replace('`[ ]*([\.])`', '$1 ', $strText)); // Pad sentence terminators
        // echo 'replace 11: '.$strText."\n";

        $strText = trim($strText);
        // echo 'replace 12: '.$strText."\n";

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
    public function wordCount(): int
    {
        $strText = $this->getTextSource();
        $strText = $this->cleanText($strText);
        // echo 'replace 13: '.$strText."\n";
        if (strlen(trim($strText)) == 0) {
            return 0;
        }

        // Will be tripped by em dashes with spaces either side, among other similar characters
        $intWords = 1 + $this->textLength(preg_replace('`[^ ]`', '', preg_replace('`\s+`', ' ', $strText))); // Space count + 1 is word count

        return $intWords;
    }
}
