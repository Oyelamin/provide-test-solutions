<?php
/**
 * Created by PhpStorm.
 * User: blessing
 * Date: 09/08/2023
 * Time: 11:27 am
 */


function numberOfItems(array $Sarr, string $needle): int
{
    // Write some code to tell me how many of my selected fruit is in these lovely nested arrays.
    $count = 0;

    foreach ($Sarr as $item) {
        if (is_array($item)) {
            $count += numberOfItems($item, $needle); // Recursive call for nested arrays
        } elseif ($item === $needle) {
            $count++;
        }
    }

    return $count;
}

$arr = ['apple', ['banana', 'strawberry', 'apple', ['banana', 'strawberry', 'apple']]];

echo numberOfItems($arr, 'apple') . PHP_EOL;