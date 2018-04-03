<?php declare(strict_types=1);

namespace Talkative;

class TextStatistics
{
    /**
     * @var string $strText Holds the last text checked. If no text passed to
     * function, it will use this text instead.
     */
    private $file;

    /**
     * Constructor.
     *
     * @param  string  $strEncoding Optional character encoding.
     * @return void
     */
    public function __construct(TextSource $textSource)
    {
        $this->textSource = $textSource;
        $this->textUtils = new TextUtils();
    }

    /**
     * Clean the text and srore it for subsequent queries.
     * @param   string|boolean  $strText Text to be checked
     * @return  string                   Cleaned text
     */
    public function setText()
    {
        if ($fileContent = $this->textSource->getStringText()) {
            return $this->textUtils->cleanText($fileContent);
        } else {
            return new WrongFileNameException('wrong file name');
        }
    }

    /**
     * Returns word count for text.
     * @return  int
     */
    public function wordCount()
    {
        if ($strText = $this->setText()) {
            return $this->textUtils->wordCount($strText);
        } else {
            return new WrongFileNameException('wrong file name');
        }
    }
}
