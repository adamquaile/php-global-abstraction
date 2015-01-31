# Global scope abstraction for PHP

This library provides object-oriented wrappers around some of the features of PHP affecting global scope. Right now, the only implemented feature is constants. 

[Global state is evil](http://programmers.stackexchange.com/questions/148108/why-is-global-state-so-evil). Avoid it wherever possible. Do not think this library makes it okay. 

This library has two main use cases: 

  - when you're working in an environment where it's unavoidable, and you still want code you write as testable as possible
  - while you're refactoring your code to get out of this mess
  
## Usage

Install it with composer, `adamquaile/php-global-abstraction`. 
  

    <?php
    
    $constants = new \AdamQuaile\PhpGlobal\Constants\ConstantWrapper();
    
    $constants->set('key', 'value');
    $constants->get('key');
    $constants->isDefined('key');


