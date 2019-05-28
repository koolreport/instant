<?php

namespace koolreport\instant;

class Exporter
{
    static function export($path)
    {
        $report = new ExporterTempReport(array("path"=>$path));
        return $report->export();
    }
}