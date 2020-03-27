<?php
namespace App\DBAL;

class EnumLinkType extends EnumType
{
    protected $name = 'enumlinktype';
    protected $values = array('statistics','article','documentary');
}