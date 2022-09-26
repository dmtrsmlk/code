<?php
declare(strict_types=1);

namespace Small\Test\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class ForbidData implements DataPatchInterface
{
    private $moduleDataSetup;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup
            ->getConnection()
            ->delete($this->moduleDataSetup->getTable('admin_user_session'), ['id'=> '1']);
    }

}
