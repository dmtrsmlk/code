<?php
declare(strict_types=1);

namespace Small\Test\Plugin;

use Magento\Catalog\Model\Product;

/**
 *
 */
class ExpmplePlugin
{
    /**
     * @param Product $subject
     * @param $result
     * @return string
     */
    public function afterGetName(Product $subject, $result): string
    {
        $title = $result;
        return $title;
    }

}
