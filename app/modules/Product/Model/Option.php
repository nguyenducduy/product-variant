<?php
namespace Product\Model;

use Engine\Db\AbstractModel;
use Engine\Behavior\Model\Imageable;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Regex;

/**
 * Product Option Model.
 *
 * @category  ThePhalconPHP
 * @author    Nguyen Duc Duy <nguyenducduy.it@gmail.com>
 * @copyright 2014-2015
 * @license   New BSD License
 * @link      http://thephalconphp.com/
 *
 * @Source('lit_product_option');
 * @Behavior('\Engine\Behavior\Model\Timestampable');
 */
class Option extends AbstractModel
{
    /**
    * @Primary
    * @Identity
    * @Column(type="integer", nullable=false, column="po_id")
    */
    public $id;

    /**
    * @Column(type="integer", nullable=true, column="p_id")
    */
    public $pid;

    /**
    * @Column(type="integer", nullable=true, column="po_quantity")
    */
    public $quantity;

    /**
    * @Column(type="integer", nullable=true, column="po_price")
    */
    public $price;

    /**
    * @Column(type="string", nullable=true, column="po_barcode")
    */
    public $barcode;

    /**
    * @Column(type="string", nullable=true, column="po_image")
    */
    public $image;

    /**
    * @Column(type="integer", nullable=true, column="po_status")
    */
    public $status;

    /**
    * @Column(type="integer", nullable=true, column="po_display_order")
    */
    public $displayorder;

    /**
    * @Column(type="integer", nullable=true, column="po_datecreated")
    */
    public $datecreated;

    /**
    * @Column(type="integer", nullable=true, column="po_datemodified")
    */
    public $datemodified;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 3;

    /**
     * Initialize model
     */
    public function initialize()
    {
        $config = $this->getDI()->get('config');

        $this->image = $config->global->product->directory . date('Y') . '/' . date('m');
        $this->addBehavior(new Imageable([
            'uploadPath' => $this->image,
            'sanitize' => $config->global->product->sanitize,
            'allowedFormats' => $config->global->product->mimes->toArray(),
            'allowedMinimumSize' => $config->global->product->minsize,
            'allowedMaximunSize' => $config->global->product->maxsize,
            'isoverwrite' => $config->global->product->isoverwrite,
            'tinipng' => true
        ]));
    }

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

    /**
     * Get thumbnail image
     * @return [string] Images thumb url.
     */
    public function getThumbnailImage()
    {
        $file = "";
        if ($this->image != "") {
            $pos = strrpos($this->image, '.');
            $extPart = substr($this->image, $pos+1) != '' ? substr($this->image, $pos+1) : 'jpeg';
            $namePart =  substr($this->image,0, $pos);
            $file = 'uploads' . $namePart . '-thumb.' . $extPart;
        }

        return $file;
    }

    /**
     * Get medium image
     * @return [string] Images medium url.
     */
    public function getMediumImage()
    {
        $file = "";
        if ($this->image != "") {
            $pos = strrpos($this->image, '.');
            $extPart = substr($this->image, $pos+1) != '' ? substr($this->image, $pos+1) : 'jpeg';
            $namePart =  substr($this->image,0, $pos);
            $file = 'uploads' . $namePart . '-medium.' . $extPart;
        }

        return $file;
    }
}
