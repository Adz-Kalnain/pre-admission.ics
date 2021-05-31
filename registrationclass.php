<?php
class MyClass
{
private $appid;


// set user's first name
public function setAppid($appid)
{
$this->appid = $appid;
}

public function getAppid()
{
return $this->appid;
}
}
?>