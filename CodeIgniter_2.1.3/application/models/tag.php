<?php
class Tag extends DataMapper {

    public $has_many = array('bookmark');

    function __construct()
    {
        parent::__construct();
    }

}
