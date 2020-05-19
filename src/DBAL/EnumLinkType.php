<?php
namespace App\DBAL;

class EnumLinkType extends EnumType
{
    const LINK_STATISTICS   = 'statistics';
    const LINK_ARTICLE      = 'article';
    const LINK_DOCUMENTARY  = 'documentary';

    protected $name = 'enumlinktype';
    protected $values = array('statistics','article','documentary');

    const CHOICES = array(
        'Statistics' => self::LINK_STATISTICS,
        'Article' => self::LINK_ARTICLE,
        'Documentary' => self::LINK_DOCUMENTARY
    );
}
