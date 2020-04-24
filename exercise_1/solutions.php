<?php
//------------------------------------------------------
//------------------ PROBLEM 1 -------------------------
//------------------------------------------------------

function maxProfit(array $pricesAndPurchases): int
{
    //Making array with all the prices and corresponding days.
    $pricesAndDays = [];
    foreach ($pricesAndPurchases as $day => $value) {
        $pricesAndDays[] = ['price' => $value['price'], 'day' => $day];
    }

    //Sorting pricesAndDays array by price value in descending order.
    function mySort($a, $b)
    {
        if ($a['price'] === $b['price']) {
            return 1;
        }
        return ($a['price'] > $b['price']) ? -1 : 1;
    }

    usort($pricesAndDays, 'mySort');

    $daysToSell = [];
    //Adding highest-price day as a starting point to daysToSell.
    $daysToSell[] = $pricesAndDays[0]['day'];

    /*
       Adding to daysToSell array days, that ar higher than highest-price day
       from sorted priceAndDays array.
    */
    for ($i = 1; $i < count($pricesAndDays); $i++) {
        if ($pricesAndDays[$i]['day'] > $daysToSell[count($daysToSell) - 1]) {
            $daysToSell[] = $pricesAndDays[$i]['day'];
        }
    }

    $currentStock = 0;
    $totalMoneySpent = 0;
    $totalRevenue = 0;

    foreach ($pricesAndPurchases as $day => $value) {
        $totalMoneySpent += $value['price'] * $value['purchased'];
        $currentStock += $value['purchased'];

        //If daysToSell array contains current day. We sell everything.
        if (in_array($day, $daysToSell)) {
            $totalRevenue += $value['price'] * $currentStock;
            $currentStock = 0;
        }
    }
    return $totalRevenue - $totalMoneySpent;

}

//$oilMarket = [
//    0 => ['price' => 2, 'purchased' => 1],
//    1 => ['price' => 8, 'purchased' => 1],
//    2 => ['price' => 10, 'purchased' => 1],
//    3 => ['price' => 4, 'purchased' => 1],
//    4 => ['price' => 9, 'purchased' => 1]
//
//];
//echo(maxProfit($oilMarket));


//------------------------------------------------------
//------------------ PROBLEM 2 -------------------------
//------------------------------------------------------

function stringCost(string $a, string $b,
                    int $insertionCost, int $deletionCost, int $replacementCost): int
{
    //Checking if replacing is more expensive than delete+insert
    $isReplaceMoreExpensive = false;
    if (($insertionCost + $deletionCost) < $replacementCost) {
        $isReplaceMoreExpensive = true;
    }
    $first = str_split($a);
    $targetWord = str_split($b);
    $result = [];
    $moneySpent = 0;

    if (strlen($a) <= strlen($b)) {
        $howManyToInsert = strlen($b) - strlen($a);
        for ($i = 0; $i < count($first); $i++) {
            if ($first[$i] !== $targetWord[$i]) {
                if ($isReplaceMoreExpensive) {
                    $moneySpent += ($deletionCost + $insertionCost);
                } else {
                    $moneySpent += $replacementCost;
                }
            }
            $result[] = $targetWord[$i];
        }
        $moneySpent += $howManyToInsert * $insertionCost;
    } else {
        $howManyDeletes = strlen($a) - strlen($b);
        for ($i = 0; $i < count($targetWord); $i++) {
            if ($first[$i] !== $targetWord[$i]) {
                if ($isReplaceMoreExpensive) {
                    $moneySpent += ($deletionCost + $insertionCost);
                } else {
                    $moneySpent += $replacementCost;
                }
            }
            $result[] = $targetWord[$i];
        }
        $moneySpent += $howManyDeletes * $deletionCost;
    }
    return $moneySpent;


}

//echo(stringCost('bitten', 'meeting', 2, 3, 6));

//------------------------------------------------------
//------------------ PROBLEM 3 -------------------------
//------------------------------------------------------
function incrementalMedian(array $values):array
{
    $result = [];
    $i = 1;
    while ($i <= count($values)) {
        $testArr = array_slice($values, 0, $i);
        sort($testArr);
        if (count($testArr) % 2 !== 0) {
            $medianIndex = floor(count($testArr) / 2);
        }
        $result[] = $testArr[$medianIndex];
        $i++;
    }
    return $result;

}

//var_dump(incrementalMedian([1, 8, 4, 7, 13]));