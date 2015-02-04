# Global scope abstraction for PHP

This library provides object-oriented wrappers around some of the features of PHP affecting global scope. 

The currently implemented features are:
 
  - Constants
  - Functions 
  - Echo / Print

[Global state is evil](http://programmers.stackexchange.com/questions/148108/why-is-global-state-so-evil). Avoid it wherever possible. Do not think this library makes it okay. 

This library has two main use cases: 

  - when you're working in an environment where it's unavoidable, and you still want code you write as testable as possible
  - while you're refactoring your code to get out of this mess
  
## Usage

Install it with composer, `adamquaile/php-global-abstraction`. 

**Constants**
  

    <?php
    
    $constants = new \AdamQuaile\PhpGlobal\Constants\ConstantWrapper();
    
    $constants->set('key', 'value');
    $constants->get('key');
    $constants->isDefined('key');

**Functions**

    <?php
    
    $functions = new \AdamQuaile\PhpGlobal\Functions\FunctionWrapper(
        new FunctionCreator(),
        new FunctionInvoker()
    );
    
    # Create function with a specified name
    
    $functions->create($callable, 'func_in_global_scope');
    \func_in_global_scope($arguments);
    
    
    # Create function and return its automatically generated name
    
    $functionName = $functions->create($callable);
    $$functionName($arguments);
    
    # Call a function existing in global scope
    $functions->invoke('strlen', 'hello world');
    
**Echo / Print**

    <?php
    
    $output = new \AdamQuaile\PhpGlobal\Output\EchoWrapper();
    
    $output->output('Hello ', $world);