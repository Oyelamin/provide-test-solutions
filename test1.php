<?php
/**
 * Created by PhpStorm.
 * User: blessing
 * Date: 09/08/2023
 * Time: 11:05 am
 */

// @Task: Make $mySecret public using Reflection.

final class ReflectionTest {
    private $mySecret = 'I have 99 problems. This isn\'t one of them.';
}

// Create an instance of ReflectionClass to inspect the structure and properties of the ReflectionTest class
$reflectionClass = new ReflectionClass('ReflectionTest');

// Get the "mySecret" property of the object instance
$property = $reflectionClass->getProperty('mySecret');

// Allow access to the private property
$property->setAccessible(true);

// Retrieve and display the value of the private property
echo $property->getValue(new ReflectionTest());

// Don't edit anything else!
//check
