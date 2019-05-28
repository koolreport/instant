<?php

namespace koolreport\instant;

class Widget
{
    static function create($widgetClass,$widgetParams,$assets=true)
    {
        
        $params = array_merge(array(
            "@widgetClass"=>$widgetClass,
            "@widgetParams"=>$widgetParams,
            "@assets"=>$assets
        ),$_GET,$_POST);
        
        $tempReport = new TempReport($params);
        $tempReport->render();
    }
    static function html($widgetClass,$widgetParams,$assets=true)
    {
        $params = array_merge(array(
            "@widgetClass"=>$widgetClass,
            "@widgetParams"=>$widgetParams,
            "@assets"=>$assets
        ),$_GET,$_POST);
        $tempReport = new TempReport($params);
        return $tempReport->render(true);    
    }
}