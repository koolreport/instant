<?php

namespace koolreport\instant;

class Widget
{
    static function create($widgetClass,$widgetParams,$reportSettings=array())
    {
        $params = array_merge(array(
            "@widgetClass"=>$widgetClass,
            "@widgetParams"=>$widgetParams,
            "@reportSettings"=>$reportSettings
        ),$_GET,$_POST);
        $tempReport = new TempReport($params);
        $tempReport->render();
    }
    static function html($widgetClass,$widgetParams,$reportSettings=array())
    {
        $params = array_merge(array(
            "@widgetClass"=>$widgetClass,
            "@widgetParams"=>$widgetParams,
            "@reportSettings"=>$reportSettings
        ),$_GET,$_POST);
        $tempReport = new TempReport($params);
        return $tempReport->render(true);    
    }
}