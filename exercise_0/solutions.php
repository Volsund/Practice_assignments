<?php

//+++++++++++++++++++++++++Problem 1+++++++++++++++++++++++++++++++++++++
function findOddEvenPair(array $numbers): int
{
    for ($i = 0; $i < count($numbers); $i++) {
        if ($i < count($numbers) - 1) {
            if (($numbers[$i] % 2 === 0 && $numbers[$i + 1] % 2 !== 0) ||
                ($numbers[$i] % 2 !== 0 && $numbers[$i + 1] % 2 === 0)) {
                return $i;
            }
        }
    }
}

//echo(findOddEvenPair($nums = [1, 2, 4, 3, 7]));


//++++++++++++++PROBLEM 2+++++++++++++++++++++
class SummationService
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function sum(int $a, int $b): int
    {
        $sum = 0;
        for ($i = $a; $i <= $b; $i++) {
            $sum += $this->data[$i];
        }
        return $sum;
    }
}

//$service = new SummationService([-1, 0, 2, 7, -15]);
//echo($service->sum(1,3));


//+++++++++++++++++++++++++PROBLEM 3++++++++++++++++++++++++++++++++
function longestSubstr(string $text): string
{
    $pairs = [];

    $helper = 2;
    for ($i = 0; $i < strlen($text) - 1; $i++) {
        $pairs[] = substr($text, $i, $helper);
    }

    $testStr = '';
    $result = '';
    $longestReached = false;
    for ($i = 0; $i < strlen($text); $i++) {
        $testStr .= $text[$i];
        foreach ($pairs as $pair) {
            if (substr_count($testStr, $pair) > 1) {
                $longestReached = true;
            };

        }
        if ($longestReached) {
            break;
        }
        $result .= $text[$i];
    }
    return $result;
}

//echo(longestSubstr('aZAzaz'));




