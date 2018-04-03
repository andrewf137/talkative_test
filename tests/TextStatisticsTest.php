<?php declare(strict_types=1);

namespace Talkative;

use PHPUnit\Framework\TestCase;

class TextStatisticsTest extends TestCase
{
    /**
     * Test instantiate OutputIntegersList class.
     */
    // public function testInstantiateOutputIntegersList()
    // {
    //     $obj = new OutputIntegersList();

    //     $this->assertInstanceOf(OutputIntegersList::class, $obj);
    // }

    /**
     * Test throw exception when one input argument is missing.
     *
     * @params string $a
     *
     * @testWith      []
     *
     * @expectedException ArgumentCountError
     */
    public function testMissingFileName(string $fileName)
    {
        $textSource = new TextStatistics();
        // $textSource->getStringText();
        // $obj = new TextStatistics($textSource);
        // echo ($obj->wordCount());
        // $obj = new OutputIntegersList();
        // $obj->validateArgs($a);
    }

    /**
     * Test throw exception when one input argument is missing.
     *
     * @params string $a
     *
     * @testWith      ["input4.txt"]
     *                ["input"]
     *
     * @expectedException WrongFileNameException
     */
    public function testWrongFileName(string $fileName)
    {
        $textSource = new TextSource($fileName);
        $textSource->getStringText();
        $obj = new TextStatistics($textSource);
        // echo ($obj->wordCount());
        // $obj = new OutputIntegersList();
        // $obj->validateArgs($a);
    }

    /**
     * Test throw exception when both input arguments are missing.
     *
     * @expectedException ArgumentCountError
     */
    // public function testBothArgumentsMissing()
    // {
    //     $obj = new OutputIntegersList();
    //     $obj->validateArgs();
    // }

    /**
     * Test throw exception when some input argument is not integer.
     *
     * @params string $a
     * @params string $b
     *
     * @testWith      ["a", "b"]
     *                [1, "b"]
     *                ["a", 99]
     *
     * @expectedException TypeError
     */
    // public function testWrongTypeArguments(mixed $a, mixed $b)
    // {
    //     $obj = new OutputIntegersList();
    //     $obj->validateArgs($a, $b);
    // }

    /**
     * Test alpha argument out of range.
     *
     * @params int $alpha
     *
     * @testWith   [-759]
     *             [0]
     *             [200]
     */
    // public function testAlphaOutOfRange(int $alpha)
    // {
    //     $obj = new OutputIntegersList();
    //     $this->expectException(OutOfRangeException::class);
    //     $obj->validateArgs($alpha, 100);
    // }

    /**
     * Test omega argument out of range.
     *
     * @params int $omega
     *
     * @testWith   [-101]
     *             [0]
     *             [333]
     */
    // public function testOmegaOutOfRange(int $omega)
    // {
    //     $obj = new OutputIntegersList();
    //     $this->expectException(OutOfRangeException::class);
    //     $obj->validateArgs(1, $omega);
    // }

    /**
     * Test arguments in bad order.
     *
     * @params string $alpha
     * @params string $omega
     *
     * @testWith      [100, 1]
     *                [77, 77]
     *                [50, 49]
     *
     * @expectedException TypeError
     */
    // public function testArgsInBadOrder(int $alpha, int $omega)
    // {
    //     $obj = new OutputIntegersList();
    //     $this->expectException(BadOrderException::class);
    //     $obj->validateArgs($alpha, $omega);
    // }

    /**
     * Test buildIntegersList with valid input arguments.
     *
     * @dataProvider validInputArguments
     */
    // public function testBuildIntegersListOk(int $alpha, int $omega, string $expected_result)
    // {
    //     $obj = new OutputIntegersList();
    //     $obj->validateArgs($alpha, $omega);
    //     $output = $obj->buildIntegersList();
    //     $this->assertEquals($expected_result, $output);
    // }

    /**
     * Provides valid ouput.
     *
     * @return array
     */
    // public function validInputArguments(): array
    // {
    //     $oneToOneHundred = [];
    //     for ($i = 1; $i <= 100; $i++) {
    //         $item  = $i;
    //         $item .= $i % 3 === 0 ? " fizz" : '';
    //         $item .= $i % 5 === 0 ? " buzz" : '';
    //         $oneToOneHundred[] = $item;
    //     }

    //     return [
    //         'alpha = 1, omega = 100' => [
    //             'alpha'     => 1,
    //             'omega'       => 100,
    //             'expected_result' => implode(PHP_EOL, $oneToOneHundred),
    //         ],
    //         'alpha = 17, omega = 39' => [
    //             'alpha'     => 17,
    //             'omega'       => 39,
    //             'expected_result' => implode(PHP_EOL, [
    //                 '17',
    //                 '18 fizz',
    //                 '19',
    //                 '20 buzz',
    //                 '21 fizz',
    //                 '22',
    //                 '23',
    //                 '24 fizz',
    //                 '25 buzz',
    //                 '26',
    //                 '27 fizz',
    //                 '28',
    //                 '29',
    //                 '30 fizz buzz',
    //                 '31',
    //                 '32',
    //                 '33 fizz',
    //                 '34',
    //                 '35 buzz',
    //                 '36 fizz',
    //                 '37',
    //                 '38',
    //                 '39 fizz',
    //             ]),
    //         ],
    //         'alpha = 79, omega = 99' => [
    //             'alpha'     => 79,
    //             'omega'       => 99,
    //             'expected_result' => implode(PHP_EOL, [
    //                 '79',
    //                 '80 buzz',
    //                 '81 fizz',
    //                 '82',
    //                 '83',
    //                 '84 fizz',
    //                 '85 buzz',
    //                 '86',
    //                 '87 fizz',
    //                 '88',
    //                 '89',
    //                 '90 fizz buzz',
    //                 '91',
    //                 '92',
    //                 '93 fizz',
    //                 '94',
    //                 '95 buzz',
    //                 '96 fizz',
    //                 '97',
    //                 '98',
    //                 '99 fizz',
    //             ]),
    //         ],
    //     ];
    // }
}
