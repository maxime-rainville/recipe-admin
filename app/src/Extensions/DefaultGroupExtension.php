<?php

use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Group;
use SilverStripe\Security\Permission;

class DefaultGroupExtension extends DataExtension
{

    private static $default_groups = [
        [
            'Title' => 'Dog Managers',
            'Description' => 'Can administer dogs.',
            'Permissions' => ['DOG_EDIT', 'DOG_VIEW', 'BREED_VIEW', 'CMS_ACCESS_DogAdmin']
        ],
        [
            'Title' => 'Breed Managers',
            'Description' => 'Can administer dogs and dog breeds.',
            'Permissions' => [
                'BREED_EDIT',
                'BREED_VIEW',
                'DOG_EDIT',
                'DOG_VIEW',
                'CMS_ACCESS_DogAdmin',
                'CMS_ACCESS_ReportAdmin'
            ]
        ]
    ];

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