<?php
declare(strict_types=1);

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
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result): string
    {
        $title = $result;
        return $title;
    }

}
