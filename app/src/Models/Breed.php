<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class Breed extends DataObject implements PermissionProvider {

    private static $table_name = 'Breed';

    private static $summary_fields = [
        'Name' => 'Dog Breed'
    ];

    private static $db = [
        'Name' => 'Varchar',
        'AverageSize' => 'Enum("tiny,small,medium,big,gigantic")'
    ];

    public function providePermissions()
    {
        $category = DogAdmin::menu_title();
        return [
            "BREED_EDIT" => array(
                'name' => _t('Breed.VIEW', "Create, edit and delete {title}", array(
                    'title' => $this->i18n_plural_name()
                )),
                'category' => $category
            ),
            "BREED_VIEW" => array(
                'name' => _t('Breed.VIEW', "Can view {title}", array(
                    'title' => $this->i18n_plural_name()
                )),
                'category' => $category
            )
        ];
    }

    public function validate()
    {
        $results = parent::validate();

        if (!trim($this->Name)) {
            $results->addFieldError('Name', 'Name is required.');
        }

        return $results;
    }

    public function canEdit($member = null)
    {
        return
            Permission::check('BREED_EDIT', 'any', $member) ?
                true :
                parent::canEdit($member);
    }

    public function canCreate($member = null, $context = [])
    {
        return
            Permission::check('BREED_EDIT', 'any', $member) ?
                true :
                parent::canCreate($member, $context);
    }

    public function canDelete($member = null)
    {
        return
            Permission::check('BREED_EDIT', 'any', $member) ?
                true :
                parent::canCreate($member);
    }

    public function canView($member = null)
    {
        return
            Permission::check('BREED_VIEW', 'any', $member) ?
                true :
                parent::canCreate($member);
    }

}