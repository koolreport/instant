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
    static function html($class,$params)
    {
        $tempReport = new TempReport(array(
            "class"=>$class,
            "params"=>$params,
        ));
        return $tempReport->render(true);        
    }
}