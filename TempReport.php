<?php

namespace koolreport\instant;

class TempReport extends \koolreport\KoolReport
{
    function settings()
    {
        if(gettype($this->params["@assets"])==="array")
        {
            //Manual
            return array(
                "assets"=>$this->params["@assets"]
            );    
        }
        else if ($this->params["@assets"]===false)
        {
            //Nothing
            return array();
        }

        // Else auto place the assets
        $assets_path = str_replace("\\","/",dirname($_SERVER["SCRIPT_FILENAME"]))."/koolreport_assets";
        if(!is_dir($assets_path))
        {
            mkdir($assets_path,0755);
        }
        return array(
            "assets"=>array(
                "path"=>$assets_path,
                "url"=>"koolreport_assets"
            )
        );
    }
}