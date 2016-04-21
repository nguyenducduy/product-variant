<?php
namespace Product\Model;

use Engine\Db\AbstractModel;
use Engine\Behavior\Model\Imageable;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Regex;

/**
 * Product Model.
 *
 * @category  ThePhalconPHP
 * @author    Nguyen Duc Duy <nguyenducduy.it@gmail.com>
 * @copyright 2014-2015
 * @license   New BSD License
 * @link      http://thephalconphp.com/
 *
 * @Source('lit_product');
 * @HasOne('id', '\Core\Model\Slug', 'objectid', {'alias': 'seo'})
 * @HasOne('pcid', '\Pcategory\Model\Pcategory', 'id', {'alias': 'category'})
 * @HasMany('id', '\Core\Model\Image', 'pid', {'alias': 'gallery'})
 * @Behavior('\Engine\Behavior\Model\Timestampable');
 */
class Product extends AbstractModel
{
    /**
    * @Primary
    * @Identity
    * @Column(type="integer", nullable=false, column="p_id")
    */
    public $id;

    /**
    * @Column(type="integer", nullable=true, column="v_id")
    */
    public $vid;

    /**
    * @Column(type="integer", nullable=true, column="pc_id")
    */
    public $pcid;

    /**
    * @Column(type="string", nullable=true, column="p_name")
    */
    public $name;

    /**
    * @Column(type="string", nullable=true, column="p_barcode")
    */
    public $barcode;

    /**
    * @Column(type="string", nullable=true, column="p_content")
    */
    public $content;

    /**
    * @Column(type="string", nullable=true, column="p_summary")
    */
    public $summary;

    /**
    * @Column(type="string", nullable=true, column="p_image")
    */
    public $image;

    /**
    * @Column(type="string", nullable=true, column="p_vendor_price")
    */
    public $vendorprice;

    /**
    * @Column(type="string", nullable=true, column="p_sell_price")
    */
    public $sellprice;

    /**
    * @Column(type="integer", nullable=true, column="p_discount_percent")
    */
    public $discountpercent;

    /**
    * @Column(type="integer", nullable=true, column="p_is_hot")
    */
    public $ishot;

    /**
    * @Column(type="integer", nullable=true, column="p_is_new")
    */
    public $isnew;

    /**
    * @Column(type="integer", nullable=true, column="p_is_gift")
    */
    public $isgift;

    /**
    * @Column(type="integer", nullable=true, column="p_in_stock")
    */
    public $instock;

    /**
    * @Column(type="integer", nullable=true, column="p_quantity")
    */
    public $quantity;

    /**
    * @Column(type="string", nullable=true, column="p_seo_description")
    */
    public $seodescription;

    /**
    * @Column(type="string", nullable=true, column="p_seo_keyword")
    */
    public $seokeyword;

    /**
    * @Column(type="integer", nullable=true, column="p_status")
    */
    public $status;

    /**
    * @Column(type="integer", nullable=true, column="p_display_order")
    */
    public $displayorder;

    /**
    * @Column(type="integer", nullable=true, column="p_datecreated")
    */
    public $datecreated;

    /**
    * @Column(type="integer", nullable=true, column="p_datemodified")
    */
    public $datemodified;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 3;

    public function getStatusName()
    {
        $name = '';

        switch ($this->status) {
            case self::STATUS_ENABLE:
                $name = 'label-status-enable';
                break;
            case self::STATUS_DISABLE:
                $name = 'label-status-disable';
                break;
        }

        return $name;
    }

    public static function getStatusList()
    {
        return $data = [
            [
                "name" => 'label-status-enable',
                "value" => self::STATUS_ENABLE
            ],
            [
                "name" => 'label-status-disable',
                "value" => self::STATUS_DISABLE
            ],
        ];
    }

    public static function getStatusListArray()
    {
        return [
            self::STATUS_ENABLE,
            self::STATUS_DISABLE,

        ];
    }

    /**
     * Get label style for status
     */
    public function getStatusStyle()
    {
        $class = '';
        switch ($this->status) {
            case self::STATUS_ENABLE:
                $class = 'label label-info';
                break;
            case self::STATUS_DISABLE:
                $class = 'label label-important';
                break;
        }

        return $class;
    }
}
