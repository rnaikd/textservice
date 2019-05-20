# TextService
I've created very tiny lib to support developers to use text functions very easily which are very easy to code but used a lot, so we can use them centrally in library.

# How to use?
Just clone or download class file and add in libraries, do not forget to load your libraries, or you can just include this file in base class, so that it can be accessed from anywhere in project.

Do not forget to add ENV constant in project to make this library work perfectly.
define(ENV, 'dev');             // For development environment
define(ENV, 'test');            // For testing envionment
define(ENV, 'stage');           // For stagingnment
define(ENV, 'production');      // For livevironment

# What does this library provide?
1. getError()
  * Manage errors in application
  * Error will only display in dev and test environment
  * In case of stage and production environment 500 page will be displayed

2. format()
  * Format string where required, many string formating functions have been handled in one function.
  
3. p()
  * Print data in dev or test environment, fedup of writting 3-4 lines everytime to just check output for debugging?
  * By mistake debug has been echoed on stage or production environment?
  * Use this function for rescue 
  * example: 
  *- TextService::P($data);
  *- TextService::P([$request, $responce]);

4. makeName()
  * This function identifies salutation, first and last name from name string and returns an array 
  
5. makeAddress()
  *  Manage address in string by giving inputs in array
  
6. getDateInFormat()
  * Manage date format accross application, set default value to reduce some work
