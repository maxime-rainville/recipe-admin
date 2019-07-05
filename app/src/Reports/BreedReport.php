<?php

use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataQuery;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\Reports\Report;
use SilverStripe\ORM\DB;
use SilverStripe\Versioned\Versioned;

/**
 * Simple report counting the number of dogs for each breed.
 */
class BreedReport extends Report
{

    public function title()
    {
        return _t(__CLASS__.'.BREED_REPORT', "Breed Report");
    }


    public function sourceRecords($params = null)
    {

        $dogTable = Dog::singleton()->baseTable();
        $breedTable = Breed::singleton()->baseTable();

        $select = SQLSelect::create(
            sprintf('"%s"."%s"', $breedTable, 'Name'),
            $breedTable
        );
        $select->addLeftJoin($dogTable, sprintf('"%s"."%s"="%s"."%s"', $breedTable, 'ID', $dogTable, 'BreedID'));
        $select->addSelect(sprintf('count("%s"."%s") as "DogCount"', $dogTable, 'BreedID'));
        $select->addGroupBy(sprintf('"%s"."%s"', $breedTable, 'ID'));

        $results = $select->execute();

        $list = ArrayList::create();

        foreach ($results as $r) {
            $list->add($r);
        }

        return $list;
    }

    public function getCount($params = array())
    {
        return Breed::get()->count();
    }

    public function columns()
    {
        return array(
            'Name' => 'Breed Name',
            'DogCount' => 'Dog count',
        );
    }
}
