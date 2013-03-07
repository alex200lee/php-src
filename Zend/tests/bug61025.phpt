--TEST--
Bug #61025 (__invoke() missing visibility and static checking)
--FILE--
<?php

interface IInvoke {
	public static function __invoke();
}

class Foo {
	public static function __invoke() {
		echo __CLASS__;
	}
}

class Bar {
	private function __invoke() {
		echo __CLASS__;
	}
}
?>
===DONE===
--EXPECTF--
Warning: The magic method __invoke() must have public visibility and cannot be static in %s/bug61025.php on line %d

Warning: The magic method __invoke() must have public visibility and cannot be static in %s/bug61025.php on line %d

Warning: The magic method __invoke() must have public visibility and cannot be static in %s/bug61025.php on line %d
===DONE===