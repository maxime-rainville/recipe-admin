<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;


/**
 * Model to track a dog breed.
 *
 * @property string $Name
 * @property string $Sex
 */
class Dog extends DataObject implements PermissionProvider {

    private static $table_name = 'Dog';

    private static $db = [
        'Name' => 'Varchar',
        'Sex' => 'Enum("Female,Male")'
    ];

    private static $has_one = [
        'Breed' => Breed::class
    ];

    private static $summary_fields = [
        'Name' => 'Dog',
        'Breed.Name' => 'Breed'
    ];

    /**
     * You can use this method to provide basic validation rules for your model.
     * @return \SilverStripe\ORM\ValidationResult
     */
    public function validate()
    {
        $results = parent::validate();

        if (!trim($this->Name)) {
            $results->addFieldError('Name', 'Name is required.');
        }

        return $results;
    }

    /**
     * Provide permission related to managing this model.
     * @return array
     */
    public function providePermissions()
    {
        $category = DogAdmin::menu_title();
        return [
            "DOG_EDIT" => array(
                'name' => _t('Dog.VIEW', "Create, edit and delete {title}", array(
                    'title' => $this->i18n_plural_name()
                )),
                'category' => $category
            ),
            "DOG_VIEW" => array(
                'name' => _t('Dog.VIEW', "Can view {title}", array(
                    'title' => $this->i18n_plural_name()
                )),
                'category' => $category
            )
        ];
    }

    public function canEdit($member = null)
    {
        return
            Permission::check('DOG_EDIT', 'any', $member) ?
            true :
            parent::canEdit($member);
    }

    public function canCreate($member = null, $context = [])
    {
        return
            Permission::check('DOG_EDIT', 'any', $member) ?
                true :
                parent::canCreate($member, $context);
    }

    public function canDelete($member = null)
    {
        return
            Permission::check('DOG_EDIT', 'any', $member) ?
                true :
                parent::canCreate($member);
    }

    public function canView($member = null)
    {
        return
            Permission::check('DOG_VIEW', 'any', $member) ?
                true :
                parent::canCreate($member);
    }

}