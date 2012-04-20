--TEST--
Bug #61527 (ArrayIterator gives misleading notice on manipulate empty or moved to end array)
--FILE--
<?php
$ao = new ArrayObject(array());
$ai = $ao->getIterator();

// empty array tests
$ai->next();
var_dump($ai->key());
var_dump($ai->current());

// move to the end tests
$ao2 = new ArrayObject(array(1 => 1, 2 => 2, 3 => 3));
$ai2 = $ao2->getIterator();

// change it
$ao2->offsetUnset($ai2->key());
// should notice and rewind pointer to start (2)
$ai2->next();

// now point to 3
$ai2->next();

// should be 3
var_dump($ai2->key());
var_dump($ai2->current());

// should be at the end
$ai2->next();
var_dump($ai2->key());
var_dump($ai2->current());

$ai2->rewind();
$ai2->next();
$ai2->next();
// should reach the end
$ai2->next();

$ai2->rewind();
$ai2->next();
$ai2->next();
$ai2->key();
?>
--EXPECTF--
Notice: ArrayIterator::key(): Array was empty. No current entry available in %sbug61527.php on line %d
NULL

Notice: ArrayIterator::current(): Array was empty. No current entry available in %sbug61527.php on line %d
NULL

Notice: ArrayIterator::next(): Array was modified outside object and internal position is no longer valid in %sbug61527.php on line %d
int(3)
int(3)

Notice: ArrayIterator::key(): Array reached the end. No current entry available in %sbug61527.php on line %d
NULL

Notice: ArrayIterator::current(): Array reached the end. No current entry available in %sbug61527.php on line %d
NULL

Notice: ArrayIterator::key(): Array reached the end. No current entry available in %sbug61527.php on line %d
