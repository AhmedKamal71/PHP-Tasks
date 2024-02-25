<?php
require_once("config.php");
class Visitors
{
    private $myFile = 'counter.txt';
    private $flag = 'vivstor';
    public function __construct($myFile)
    {
        $this->$myFile = $myFile;
    }
    public function counterFunction()
    {
        session_start();
        if (!isset($_SESSION[$this->flag])) {
            $this->increaseCounter();
            $_SESSION[$this->flag] = true;
        }
        echo 'total visits' . ' : ' .  $this->getCounter();
    }
    public function increaseCounter()
    {
        $counter = $this->getCounter() + 1;
        file_put_contents($this->myFile, $counter);
    }
    public function getCounter()
    {
        return file_exists($this->myFile) ? (int) file_get_contents($this->myFile) : 0;
    }
}
