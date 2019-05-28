<?php

namespace koolreport\instant;

trait SinglePage
{
    public function start()
    {
        $this->run();
        $GLOBALS["__ACTIVE_KOOLREPORT__"] = $this;
        ob_start();
    }
    public function end()
    {
        $content = ob_get_clean();
        $this->getResourceManager()->init();
        if($this->fireEvent("OnBeforeResourceAttached"))
        {
            $this->getResourceManager()->process($content);
            $this->fireEvent("OnResourceAttached");
        }
        $this->fireEvent("OnRenderEnd",array('content'=>&$content));
        echo $content;
    }
}