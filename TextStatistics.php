<?php

namespace Talkative;

class TextStatistics
{
    /**
     * @var string $strEncoding Used to hold character encoding to be used
     * by object, if set
     */
    protected $strEncoding = '';

    /**
     * @var string $strText Holds the last text checked. If no text passed to
     * function, it will use this text instead.
     */
    private static $strText = false;

    /**
     * Constructor.
     *
     * @param  string  $strEncoding Optional character encoding.
     * @return void
     */
    public function __construct($strEncoding = '')
    {
        if ($strEncoding != '') {
            // Encoding is given. Use it!
            $this->strEncoding = $strEncoding;
        }
    }

    /**
     * Set the text to measure the readability of.
     * @param   string|boolean  $strText Text to be checked
     * @return  string                   Cleaned text
     */
    public function setText(?string $strText): string
    {
        // If text passed in, clean it up and store it for subsequent queries
        if ($strText !== false) {
            self::$strText = TextUtils::cleanText($strText);
        }

        return self::$strText;
    }

    /**
     * Returns word count for text.
     * @param   boolean|string  $strText      Text to be measured
     * @return  int
     */
    public function wordCount(?string $strText): int
    {
        $strText = $this->setText($strText);

        return TextUtils::wordCount($strText, $this->strEncoding);
    }
}
