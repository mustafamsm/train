<?php
class Autoloader
{
    public static function register($classname){
        include __DIR__ . "/{$classname}.php";
    }
    public function name($first,$last='f'){
        echo $first.$last;
    }
}
spl_autoload_register([Autoloader::class,'register'] );

  $mustafa=new Autoloader;
  $mustafa->name('mustafa');