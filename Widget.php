<?php

namespace koolreport\instant;

class Widget
{
    static function create($class,$params)
    {
        $tempReport = new TempReport(array(
            "class"=>$class,
            "params"=>$params,
        ));
        $tempReport->render();
    }
}