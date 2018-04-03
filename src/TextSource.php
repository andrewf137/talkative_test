<?php declare(strict_types=1);

namespace Talkative;

class TextSource
{
    public const MSG_INVALID_FILE_NAME = 'Invalid file name "%s"';

    private $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * Get file path from file name.
     *
     * @return string
     * @throws WrongFileNameException if name file invalid or doesn't exist.
     */
    public function getFile(): ?string
    {
        if (substr($this->file, 0, 8) === 'sources/' ||
            substr($this->file, 0, 9) === '/sources/' ||
            substr($this->file, 0, 8) === 'sources\\' ||
            substr($this->file, 0, 9) === '\\sources\\'
            ) {
            $filePath = realpath(__DIR__.'/../'.$this->file) ? $filePath : '';
        } else {
            $filePath = realpath(__DIR__.'/../sources/'.$this->file) ? $filePath : '';
        }

        if (!$filePath) {
            throw new WrongFileNameException(sprintf(static::MSG_INVALID_FILE_NAME, $this->file));
        }

        if (!file_exists($filePath)) {
            throw new WrongFileNameException(sprintf(static::MSG_INVALID_FILE_NAME, $this->file));
        }

        return $filePath;

        // try {
        //     return file_exists($filePath) ? $filePath : null;
        // } catch(WrongFileNameException $e) {
        //     echo 'Error: ' . $e->getMessage();
        // }
    }

    public function getStringText()
    {
        try {
            $filePath = $this->getFile();
            $file = fopen($filePath, 'r');
            $fileSize = filesize($filePath);
            $fileContent = fread($file, $fileSize);
            fclose( $file );
            return $fileContent;
        } catch(\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}