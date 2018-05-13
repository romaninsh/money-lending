<?php

namespace Model;

class User extends \atk4\data\Model
{
    public $table = 'user';
    function init() {
        parent::init();

        $this->addFields([
            'email',
            ['name', 'required'=>true],
            'password',
            ['is_confirmed', 'type'=>'boolean'],
            ['is_admin', 'type'=>'boolean'],
        ]);
    }
}
