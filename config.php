<?php
class clscon
{
    public $link;
    function db_connect()
    {
        $host="localhost";
        $uname="root";
        $pwd="";
      $this->link=  mysqli_connect($host,$uname, $pwd,"mytrk");
      return $this->link;
    }
    function db_close()
    {
        mysqli_close($this->link);
    }
}

?>
