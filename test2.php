<?php
/**
 * Created by PhpStorm.
 * User: blessing
 * Date: 09/08/2023
 * Time: 11:20 am
 */

var_dump(changeDateFormat(array("2010/03/30", "15/12/2016", "11-15-2012",
    "20130720")));

/**
 * When this method runs, it should return valid dates in the following format: DD/MM/YYYY.
 */
function changeDateFormat(array $dates): array
{
    $listOfDates = [];
    $closure = function (string $date) use (&$listOfDates) {
        $formattedDate = DateTime::createFromFormat('!d/m/Y', $date);
        if ($formattedDate) {
            $listOfDates[] = $formattedDate->format('d/m/Y');
        }
    };

    array_map($closure, $dates);
    return $listOfDates;
}