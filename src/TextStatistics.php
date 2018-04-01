<?php

namespace Talkative;

use Talkative\TextUtils;

class TextStatistics
{
    /**
     * @var string $strText Holds the last text checked. If no text passed to
     * function, it will use this text instead.
     */
    private $strText = false;

    /**
     * Constructor.
     *
     * @param  string  $strEncoding Optional character encoding.
     * @return void
     */
    // public function __construct(TextUtils $textUtils)
    // {
    //     $this->textUtils = $textUtils;
    // }

    /**
     * Clean the text and srore it for subsequent queries.
     * @param   string|boolean  $strText Text to be checked
     * @return  string                   Cleaned text
     */
    public function setText(?string $strText): string
    {
        if ($strText !== false) {
            $utils = new TextUtils();
            $this->strText = $utils->cleanText($strText);
        }

        return $this->strText;
    }

    /**
     * Returns word count for text.
     * @param   boolean|string  $strText      Text to be measured
     * @return  int
     */
    public function wordCount(?string $strText): int
    {
        $strText = $this->setText($strText);
        $utils = new TextUtils();
        return $utils->wordCount($strText);
    }
}
