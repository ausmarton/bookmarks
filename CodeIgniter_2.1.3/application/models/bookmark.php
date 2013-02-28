<?php
class Bookmark extends DataMapper {

    public $has_many = array('tag');

    function __construct()
    {
        parent::__construct();
    }

}
