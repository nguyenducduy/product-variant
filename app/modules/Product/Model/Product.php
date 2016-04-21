<?php
namespace Product\Model;

use Engine\Db\AbstractModel;
use Engine\Behavior\Model\Imageable;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Regex;
use Phalcon\Image\Adapter\Imagick as PhImage;

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
    * @Column(type="string", nullable=true, column="p_slug")
    */
    public $slug;

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
    const IS_HOT = 1;
    const IS_NEW = 1;

    /**
     * Form field validation
     */
    public function validation()
    {
        // $this->validate(new Regex(
        //     [
        //         'field'  => 'pcid',
        //         'pattern' => '/[1-1000]+/',
        //         'message' => 'message-pcid-notempty'
        //     ]
        // ));


        $this->validate(new PresenceOf(
            [
                'field'  => 'name',
                'message' => 'message-name-notempty'
            ]
        ));

        $this->validate(new PresenceOf(
            [
                'field'  => 'status',
                'message' => 'message-status-notempty'
            ]
        ));

        return $this->validationHasFailed() != true;
    }

    public function getSeo()
    {
        return $this->getRelated('seo', [
            'conditions' => 'model = "' . Slug::MODEL_PRODUCT . '"'
        ]);
    }

    // Get model relation with conditions
    public function getGallery()
    {
        return $this->getRelated('gallery', [
            'conditions' => 'status = ' . self::STATUS_ENABLE,
            'order' => 'id ASC'
        ]);
    }

    /**
     * Create Paginator Object for Product Listing
     *
     * @param  [array] $formData    Store condition, order, select column to prepare for query
     * @param  [int] $limit         Record per page
     * @param  [int] $offset        Current Page
     * @return [object] $paginator  Phalcon Paginator Builder Object
     */
    public static function getList($formData, $limit, $offset)
    {
        $modelName = get_class();
        $whereString = '';
        $bindParams = [];
        $bindTypeParams = [];

        if (is_array($formData['conditions'])) {
            if (isset($formData['conditions']['keyword'])
                && strlen($formData['conditions']['keyword']) > 0
                && isset($formData['conditions']['searchKeywordIn'])
                && count($formData['conditions']['searchKeywordIn']) > 0) {
                /**
                 * Search keyword
                 */
                $searchKeyword = $formData['conditions']['keyword'];
                $searchKeywordIn = $formData['conditions']['searchKeywordIn'];

                $whereString .= $whereString != '' ? ' OR ' : ' (';

                $sp = '';
                foreach ($searchKeywordIn as $searchIn) {
                    $sp .= ($sp != '' ? ' OR ' : '') . $searchIn . ' LIKE :searchKeyword:';
                }

                $whereString .= $sp . ')';
                $bindParams['searchKeyword'] = '%' . $searchKeyword . '%';
            }

            /**
             * Optional Filter by tags
             */
            if (count($formData['conditions']['filterBy']) > 0) {
                $filterby = $formData['conditions']['filterBy'];

                foreach ($filterby as $k => $v) {
                    if ($v) {
                        $whereString .= ($whereString != '' ? ' AND ' : '') . $k . ' = :' . $k . ':';
                        $bindParams[$k] = $v;

                        switch (gettype($v)) {
                            case 'string':
                                $bindTypeParams[$k] =  \PDO::PARAM_STR;
                                break;

                            default:
                                $bindTypeParams[$k] = \PDO::PARAM_INT;
                                break;
                        }
                    }
                }
            }

            if (strlen($whereString) > 0 && count($bindParams) > 0) {
                $formData['conditions'] = [
                    [
                        $whereString,
                        $bindParams,
                        $bindTypeParams
                    ]
                ];
            } else {
                $formData['conditions'] = '';
            }
        }

        $params = [
            'models' => $modelName,
            'columns' => $formData['columns'],
            'conditions' => $formData['conditions'],
            'order' => [$modelName . '.' . $formData['orderBy'] .' '. $formData['orderType'] .'']
        ];

        return parent::runPaginate($params, $limit, $offset);
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
     * Get thumbnail image
     * @return [string] Images thumb url.
     */
    public function getThumbnailImage()
    {
        $file = '';
        if ($this->image != '') {
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
        $file = '';
        if ($this->image) {
            $pos = strrpos($this->image, '.');
            $extPart = substr($this->image, $pos+1) != '' ? substr($this->image, $pos+1) : 'jpeg';
            $namePart =  substr($this->image,0, $pos);
            $file = 'uploads' . $namePart . '-medium.' . $extPart;
        }

        return $file;
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

    public function resizeImage()
    {
        $file = $this->getDI()->get('file');

        $imagePath = PUBLIC_PATH . $this->image;
        // Resize image
        $myResize = new PhImage($imagePath);
        $mediumPath = str_replace('uploads/', '', $this->getMediumImage());
        $thumbPath = str_replace('uploads/', '', $this->getThumbnailImage());

        $myResize->resize(340, 434)->crop(340, 434)->save(PUBLIC_PATH . '/' . $mediumPath);
        $myResize->resize(190, 242)->crop(190, 242)->save(PUBLIC_PATH . '/' . $thumbPath);

        return true;
    }
}
