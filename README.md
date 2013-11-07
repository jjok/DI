DI
====

[![Build Status](https://travis-ci.org/jjok/DI.png?branch=master)](https://travis-ci.org/jjok/DI)

Super-simple dependency injection for PHP.

It's a bit like [Pimple](https://github.com/fabpot/pimple), but has a namespace and does less stuff.

Example
-------

    $container = new \jjok\DI\Container(array(
        'SomeDependency' => function($self, $param) {
        	return new SomeDependency($param);
        },
        'SomeClass' => function($self) {
        	return new SomeClass($self->call('SomeDependency', 'some-param'));
        }
    ));
    
    $some_object = $container->call('SomeClass');

Dependencies
------------

- [jjok\Config](https://github.com/jjok/Config)


Copyright (c) 2013 Jonathan Jefferies
