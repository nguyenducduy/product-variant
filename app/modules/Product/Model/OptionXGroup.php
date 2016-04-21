<?php
namespace Product\Model;

use Engine\Db\AbstractModel;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Product\Model\Option;

/**
 * Relation between product option and product option group.
 *
 * @category  ThePhalconPHP
 * @author    Nguyen Duc Duy <nguyenducduy.it@gmail.com>
 * @copyright 2014-2015
 * @license   New BSD License
 * @link      http://thephalconphp.com/
 *
 * @Source('lit_product_option_x_group');
 * @HasOne('pogid', '\Product\Model\OptionGroup', 'id', {'alias': 'optiongroup'})
 * @Behavior('\Engine\Behavior\Model\Timestampable');
 */
class OptionXGroup extends AbstractModel
{
    /**
    * @Primary
    * @Identity
    * @Column(type="integer", nullable=false, column="rpog_id")
    */
    public $id;

    /**
    * @Column(type="integer", nullable=true, column="po_id")
    */
    public $poid;

    /**
    * @Column(type="integer", nullable=true, column="pog_id")
    */
    public $pogid;

    /**
    * @Column(type="string", nullable=true, column="rpog_value")
    */
    public $value;

    /**
    * @Column(type="integer", nullable=true, column="rpog_datecreated")
    */
    public $datecreated;

    /**
    * @Column(type="integer", nullable=true, column="rpog_datemodified")
    */
    public $datemodified;

    public static function checkVariant($option, $field, $value)
    {
        $sql = 'SELECT ox.poid FROM \Product\Model\OptionXGroup ox '
            . 'INNER JOIN \Product\Model\Option o '
            . 'ON (ox.poid = o.id) '
            . 'WHERE o.pid = :productId: ';

        // get product option group list
        $myOptionXGroup = OptionXGroup::findByPoid($option->id);

        // get option group field id
        $myOptionGroup = OptionGroup::findFirst([
            'name = :field:',
            'bind' => [
                'field' => ucfirst($field)
            ]
        ]);

        $whereString = '';
        foreach ($myOptionXGroup as $og) {
            if ($og->pogid == $myOptionGroup->id) {
                $whereString .= ($whereString != '' ? ' OR ' : ' AND ')
                    . ' (ox.pogid = '. $myOptionGroup->id .' AND ox.value = "'. $value .'") ';
            } else {
                $whereString .= ($whereString != '' ? ' OR ' : ' AND ')
                    . ' (ox.pogid = '. $og->pogid .' AND ox.value = "'. $og->value .'") ';
            }
        }
        $sql .= $whereString;
        $sql .= 'GROUP BY ox.poid HAVING (COUNT(ox.id) = '. count($myOptionXGroup) .')';

        $result =  parent::runQuery($sql, [
            'productId' => $option->pid
        ]);

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
        die;
    }
}
