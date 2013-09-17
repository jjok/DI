<?php

require_once '../../Config/src/jjok/Config/Config.php';
require_once '../src/jjok/DI/Container.php';

class SomeDependency {
	
	/**
	 * A test parameter.
	 * @var string
	 */
	protected $param;
	
	/**
	 * Set the test parameter.
	 * @param string $param
	 */
	public function __construct($param) {
		$this->param = $param;
	}
}

class SomeClass {
	
	/**
	 * A test object dependency.
	 * @var SomeDependency
	 */
	protected $dependency;
	
	/**
	 * Set the test dependency.
	 * @param SomeDependency $dependency
	 */
	public function __construct(SomeDependency $dependency) {
		$this->dependency = $dependency;
	}
}

$container = new \jjok\DI\Container(array(
	'SomeDependency' => function($self, $param) {
		return new SomeDependency($param);
	},
	'SomeClass' => function($self) {
		return new SomeClass($self->get('SomeDependency', 'some-param'));
	}
));

var_dump($container->get('SomeClass'));
