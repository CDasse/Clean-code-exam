<?php

declare(strict_types=1);

namespace Yatzy\Tests;

use PHPUnit\Framework\TestCase;
use Yatzy\yatzy;

class YatzyTest extends TestCase
{
    public function testChanceScoresSumOfAllDice(): void
    {
        $expected = 15;
        $actual = yatzy::chance(2, 3, 4, 5, 1);
        self::assertSame($expected, $actual);
        self::assertSame(16, yatzy::chance(3, 3, 4, 5, 1));
    }

    public function testYatzyScores50(): void
    {
        $expected = 50;
        $actual = yatzy::yatzyScore([4, 4, 4, 4, 4]);
        self::assertSame($expected, $actual);
        self::assertSame(50, yatzy::yatzyScore([6, 6, 6, 6, 6]));
        self::assertSame(0, yatzy::yatzyScore([6, 6, 6, 6, 3]));
    }

    public function testOnes(): void
    {
        self::assertSame(1, (new yatzy(1, 2, 3, 4, 5))->ones());
        self::assertSame(2, (new yatzy(1, 2, 1, 4, 5))->ones());
        self::assertSame(0, (new yatzy(6, 2, 2, 4, 5))->ones());
        self::assertSame(4, (new yatzy(1, 2, 1, 1, 1))->ones());
    }

    public function testTwos(): void
    {
        self::assertSame(4, (new yatzy(1, 2, 3, 2, 6))->twos());
        self::assertSame(10, (new yatzy(2, 2, 2, 2, 2))->twos());
    }

    public function testThrees(): void
    {
        self::assertSame(6, (new yatzy(1, 2, 3, 2, 3))->threes());
        self::assertSame(12, (new yatzy(2, 3, 3, 3, 3))->threes());
    }

    public function testFours(): void
    {
        self::assertSame(12, (new yatzy(4, 4, 4, 5, 5))->fours());
        self::assertSame(8, (new yatzy(4, 4, 5, 5, 5))->fours());
        self::assertSame(4, (new yatzy(4, 5, 5, 5, 5))->fours());
    }

    public function testFives(): void
    {
        self::assertSame(10, (new yatzy(4, 4, 4, 5, 5))->Fives());
        self::assertSame(15, (new yatzy(4, 4, 5, 5, 5))->Fives());
        self::assertSame(20, (new yatzy(4, 5, 5, 5, 5))->Fives());
    }

    public function testSixes(): void
    {
        self::assertSame(0, (new yatzy(4, 4, 4, 5, 5))->sixes());
        self::assertSame(6, (new yatzy(4, 4, 6, 5, 5))->sixes());
        self::assertSame(18, (new yatzy(6, 5, 6, 6, 5))->sixes());
    }

    public function testOnePair(): void
    {
        self::assertSame(6, (new yatzy(3, 4, 3, 5, 6))->scorePair(3, 4, 3, 5, 6));
        self::assertSame(10, (new yatzy(5, 3, 3, 3, 5))->scorePair(5, 3, 3, 3, 5));
        self::assertSame(12, (new yatzy(5, 3, 6, 6, 5))->scorePair(5, 3, 6, 6, 5));
    }

    public function testTwoPair(): void
    {
        self::assertSame(16, yatzy::twoPair(3, 3, 5, 4, 5));
        self::assertSame(18, yatzy::twoPair(3, 3, 6, 6, 6));
        self::assertSame(0, yatzy::twoPair(3, 3, 6, 5, 4));
    }

    public function testThreeOfAKind(): void
    {
        self::assertSame(9, yatzy::threeOfAKind(3, 3, 3, 4, 5));
        self::assertSame(15, yatzy::threeOfAKind(5, 3, 5, 4, 5));
        self::assertSame(9, yatzy::threeOfAKind(3, 3, 3, 2, 1));
    }

    public function testSmallStraight(): void
    {
        self::assertSame(15, yatzy::smallStraight(1, 2, 3, 4, 5));
        self::assertSame(15, yatzy::smallStraight(2, 3, 4, 5, 1));
        self::assertSame(0, yatzy::smallStraight(1, 2, 2, 4, 5));
    }

    public function testLargeStraight(): void
    {
        self::assertSame(20, yatzy::largeStraight(6, 2, 3, 4, 5));
        self::assertSame(20, yatzy::largeStraight(2, 3, 4, 5, 6));
        self::assertSame(0, yatzy::largeStraight(1, 2, 2, 4, 5));
    }

    public function testFullHouse(): void
    {
        self::assertSame(18, yatzy::fullHouse(6, 2, 2, 2, 6));
        self::assertSame(0, yatzy::fullHouse(2, 3, 4, 5, 6));
    }
}
