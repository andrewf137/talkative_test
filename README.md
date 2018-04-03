# Text Statistics 1.1.0

## Changelog
* Add folder structure
* Add exceptions
* Add composer.json
* Add codeblocks
* Change tests to extend from phpunit
* Improve index.php (to execute from command line)

## Business requirements
Write PHP code to read the contents of a plain text file and display:
  * The total number of words
  * The average word length
  * The most frequently occurring word length
  * A list of the number of words of each length

For example, given a file that contains the following text:

    Hello world & good morning. The date is 18.05.2016

the following output would be returned:

    Word count = 9
    Average word length = 4.556
    Number of words of length 1 is 1
    Number of words of length 2 is 1
    Number of words of length 3 is 1
    Number of words of length 4 is 2
    Number of words of length 5 is 2
    Number of words of length 7 is 1
    Number of words of length 10 is 1

    The most frequently occurring word length is 2, for word lengths of 4 & 5

## Requirements

* PHP 7.0.0
* composer

## Run tests
    composer install
    ./vendor/bin/phpunit

## Run from command line
    php index.php 10 25
    php index.php -15 39
    php index.php a 100
    ...
