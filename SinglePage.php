<?php
/**
 * This file contain definition for KoolReport
 *
 * @category  Core
 * @package   KoolReport
 * @author    KoolPHP Inc <support@koolphp.net>
 * @copyright 2017-2028 KoolPHP Inc
 * @license   MIT License https://www.koolreport.com/license#mit-license
 * @link      https://www.koolphp.net
 */
namespace koolreport\instant;

use \koolreport\core\Utility;

/**
 * SinglePage trait for KoolReport
 *
 * @category  Core
 * @package   KoolReport
 * @author    KoolPHP Inc <support@koolphp.net>
 * @copyright 2017-2028 KoolPHP Inc
 * @license   MIT License https://www.koolreport.com/license#mit-license
 * @link      https://www.koolphp.net
 */

trait SinglePage
{
    /**
     * Keep the old active report
     * 
     * @var KoolReport Old active report
     */
    protected $oldActiveReport;

    /**
     * Constructor
     * 
     * @return null
     */
    public function __constructSinglePage()
    {
        //assets folder
        $assets = Utility::get($this->reportSettings, "assets");
        if ($assets === null) {
            $asset_path = str_replace("\\", "/", dirname($_SERVER["SCRIPT_FILENAME"]) . "/koolreport_assets");

            if (!is_dir($asset_path)) {
                mkdir($asset_path, 0755);
            }
            $assets = array(
                "url" => "koolreport_assets",
                "path" => $asset_path,
            );
            $this->reportSettings["assets"] = $assets;
        }
    }

    /**
     * Report start
     * 
     * Call this function before rendering the html of the report view
     * 
     * @return null
     */
    public function start()
    {
        $this->run();
        $this->oldActiveReport = isset($GLOBALS["__ACTIVE_KOOLREPORT__"]) 
            ? $GLOBALS["__ACTIVE_KOOLREPORT__"] : null;
        $GLOBALS["__ACTIVE_KOOLREPORT__"] = $this;
        $this->registerEvent(
            "OnResourceInit",
            function () {
                $this->getResourceManager()->addScriptFileOnBegin(
                    $this->getResourceManager()->publishAssetFolder(
                        realpath(dirname(__FILE__) . "/../core/src/clients/core")
                    ) . "/KoolReport.js"
                );
            },
            true
        );
        $this->getResourceManager()->init();
        ob_start();
    }

    /**
     * Call this function after rendering the html of report view
     * 
     * @return null
     */
    public function end()
    {
        $content = ob_get_clean();
        if ($this->fireEvent("OnBeforeRender")) {
            if ($this->oldActiveReport === null) {
                unset($GLOBALS["__ACTIVE_KOOLREPORT__"]);
            } else {
                $GLOBALS["__ACTIVE_KOOLREPORT__"] = $this->oldActiveReport;
            }
            if ($this->fireEvent("OnBeforeResourceAttached")) {
                $this->getResourceManager()->process($content);
                $this->fireEvent("OnResourceAttached");
            }
            $this->fireEvent("OnRenderEnd", array('content' => &$content));
            echo $content;
        }
    }
}
