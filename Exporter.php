<?php

namespace koolreport\instant;

class Exporter
{
    static function export($path,$params=array())
    {
        $report = new ExporterTempReport(
            array("path"=>$path,"params"=>$params)
        );
        return $report->export();
    }

    static function cloudExport($path,$params=array())
    {
        $report = new ExporterTempReport(
            array("path"=>$path,"params"=>$params)
        );
        return $report->cloudExport();
    }    
}