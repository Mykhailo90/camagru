<?php

namespace aplication\models;

use aplication\core\Model;
use aplication\lib\Registry;
use PDO;

class Restoring_pswModel extends Model
{

    public function get_data()
    {

        $allData = array('navMenu' => 'test',
                        'programs' => '$programs',
                        'filterType' => '$filterType',
                        'filterForWhom' => '$filterForWhom',
                        'filterSubjects' => '$filterSubjects',
                        'filterTrainer' => '$filterTrainer',
                        );

        return $allData;
    }

}
