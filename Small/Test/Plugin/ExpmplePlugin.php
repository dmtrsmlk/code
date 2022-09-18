<?php

namespace Small\Test\Plugin;

/**
 *
 */
class ExpmplePlugin
{
    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param $result
     * @return string
     */
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $title = $result.' '.'!!! ';
        return $title;
    }

}
