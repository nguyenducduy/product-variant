<?php
namespace Product\Model;

use Engine\Db\AbstractModel;
use Phalcon\Mvc\Model\Validator\PresenceOf;

/**
 * Product Option Group Model.
 *
 * @category  ThePhalconPHP
 * @author    Nguyen Duc Duy <nguyenducduy.it@gmail.com>
 * @copyright 2014-2015
 * @license   New BSD License
 * @link      http://thephalconphp.com/
 *
 * @Source('lit_product_option_group');
 * @Behavior('\Engine\Behavior\Model\Timestampable');
 */
class OptionGroup extends AbstractModel
{
    /**
    * @Primary
    * @Identity
    * @Column(type="integer", nullable=false, column="pog_id")
    */
    public $id;

    /**
    * @Column(type="string", nullable=true, column="pog_name")
    */
    public $name;

    /**
    * @Column(type="integer", nullable=true, column="pog_display_order")
    */
    public $displayorder;

    /**
    * @Column(type="integer", nullable=true, column="pog_datecreated")
    */
    public $datecreated;

    /**
    * @Column(type="integer", nullable=true, column="pog_datemodified")
    */
    public $datemodified;
}
