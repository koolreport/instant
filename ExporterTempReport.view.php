<?php 
foreach ($this->params["params"] as $key=>$value) {
    $$key = $value;
}

include $this->params["path"];
?>