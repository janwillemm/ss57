<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

spl_autoload_register(NULL, FALSE);

spl_autoload_extensions('.php');

spl_autoload_register(array('Autoloader', 'load'));

// define custom ClassNotFoundException exception class

class ClassNotFoundException extends Exception{}

// define Autoloader class

class Autoloader
{

                // attempt to autoload a specified class

        public static function load($class)
        {
                if (class_exists($class, FALSE))
                {
                        return;
                }
                if (file_exists(dirname(__FILE__) . '/classes/'.$class . '.class.php'))
                {
                        require_once(dirname(__FILE__) . '/classes/'.$class . '.class.php');
                }
                elseif(strpos($class,'Slide') !== false){
                        require_once(dirname(__FILE__) . '/classes/Slide.class.php');
                }
                else
                {
                        throw new ClassNotFoundException('Class ' . $class . ' not found.');
                }
        }
}
?>