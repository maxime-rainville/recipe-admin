<?php

use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Group;
use SilverStripe\Security\Permission;

/**
 * Apply this extension to Group to add the ability to define default groups with pre-defined permissions.
 */
class DefaultGroupExtension extends DataExtension
{

    private static $default_groups = [];

    public function requireDefaultRecords()
    {
        /** @var Group $owner */
        $owner = $this->getOwner();
        if ($owner::get()->count() > 0) {
            // If there's already group bail
            return;
        }

        foreach ($owner::config()->get('default_groups') as $groupInfo) {
            $permissions = $groupInfo['Permissions'];
            unset($groupInfo['Permissions']);

            $group = $owner::create($groupInfo);
            $group->write();

            foreach ($permissions as $permission) {
                Permission::grant($group->ID, $permission);
            }
        }


    }

}