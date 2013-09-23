<?php

require_once '../Config/src/jjok/Config/Config.php';
require_once 'src/jjok/DI/Container.php';

class ContainerTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testCallingNonCallableThrowsError() {
		$container = new jjok\DI\Container(array(
			'string' => 'string'
		));
		$container->call('string');
	}
	
	public function testCallingFunctionReturnsFunctionResponse() {
		$container = new jjok\DI\Container(array(
			'function' => function($self) {
				return $self;
			},
			'function 2' => function($self) {
				return 'response';
			}
		));

		$this->assertInstanceOf('jjok\DI\Container', $container->call('function'));
		$this->assertSame('response', $container->call('function 2'));
	}
	
	public function testAdditionalParamsArePassedToCallback() {
		$container = new jjok\DI\Container(array(
			'function' => function($self) {
				return func_get_args();
			}
		));

		$this->assertCount(1, $container->call('function'));
		$this->assertCount(2, $container->call('function', 'param'));
		$this->assertCount(3, $container->call('function', 'param', 'another param'));
	}
}
