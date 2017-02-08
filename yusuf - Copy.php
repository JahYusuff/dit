<?php
class test
{
  function __isset($name)
  {
      echo "__isset is called for $name";
  }
  function __unset($name)
  {
      echo "__unset is called for $name";
  }
}
$a = new test();
isset($a->x);
unset($a->c);

?>