<?php

// if ($argc !== 3) {
// 	echo "USage: php index.php <name> <age>". PHP_EOL;
// 	exit(1);
// }

// $name = $argv[1];
// $age = $argv[2];
// echo "Hello, $name, Age => $age" . PHP_EOL;


class MyClass
{
	// Declare a public constructor
	public function __construct()
	{
	}

	// Declare a public method
	public function MyPublic()
	{
	}

	// Declare a protected method
	protected function MyProtected()
	{
		echo 'protected';
	}

	// Declare a private method
	private function MyPrivate()
	{
		echo 'Private';
	}

	// This is public
	function Foo()
	{
		$this->MyPublic();
		$this->MyProtected();
		$this->MyPrivate();
	}
}



/**
 * Define MyClass2
 */
class MyClass2 extends MyClass
{
	// This is public
	function Foo2()
	{
		$this->MyPublic();
		$this->MyProtected();
		// $this->MyPrivate(); // Fatal Error
	}
}

$myclass2 = new MyClass2;
$myclass2->MyPublic(); // Works
$myclass2->Foo2(); // Public and Protected work, not Private
