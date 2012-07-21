--TEST--
088: namespace import with from shortcut
--FILE--
<?php

namespace A {
	class B {}
}

namespace A\C {
	class X {}
	class Y {}
}

namespace {
	/*
     * use A\B
     */
	from A use B;

	/*
     * use A\B as B1;
     * use A\B as B2;
     */
	from A use B as B1, B as B2;

	/*
     * use A\C\X;
     * use A\C\Y;
     */
	from A\C use X, Y;

	/*
     * use \A\C\X as X1;
     * use \A\C\Y as Y1;
     */
	from \A\C use \X as X1, Y as Y1;

	$b = new B();
	$b1 = new B1();
	$b2 = new B2();
	$x = new X();
	$x1 = new X1();
	$y = new Y();
	$y1 = new Y1();

	var_dump($b, $b1, $b2, $x, $x1, $y, $y1);
	echo "===DONE===\n";
}
?>
--EXPECTF--
object(A\B)#1 (0) {
}
object(A\B)#2 (0) {
}
object(A\B)#3 (0) {
}
object(A\C\X)#4 (0) {
}
object(A\C\X)#5 (0) {
}
object(A\C\Y)#6 (0) {
}
object(A\C\Y)#7 (0) {
}
===DONE===
