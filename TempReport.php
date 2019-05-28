<?php

namespace koolreport\instant;

class TempReport extends \koolreport\KoolReport
{
    function settings()
    {
        return $this->params["@reportSettings"];
    }
}