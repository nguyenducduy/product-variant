<?php
namespace Home\Controller;

use Core\Controller\AbstractController;
use Pcategory\Model\Pcategory as Category;
use Product\Model\Product as Product;

/**
 * Site home.
 *
 * @category  ThePhalconPHP
 * @author    Nguyen Duc Duy <nguyenducduy.it@gmail.com>
 * @copyright 2014-2015
 * @license   New BSD License
 * @link      http://thephalconphp.com/
 *
 * @RoutePrefix("/", name="home-site-homepage")
 */
class SiteController extends AbstractController
{
    /**
     * Main action.
     *
     * @return void
     *
     * @Route("/", methods={"GET", "POST"}, name="admin-user-index")
     */
    public function indexAction()
    {
        $myAothai = Product::find([
            'pcid = :pcid: AND status = :status:',
            'bind' => [
                'pcid' => Category::findFirst([
                    'slug = "ao-thai"'
                    ])->id,
                'status' => Product::STATUS_ENABLE
            ],
            'limit' => 5
        ]);

        $myQuangchau = Product::find([
            'pcid = :pcid: AND status = :status:',
            'bind' => [
                'pcid' => Category::findFirst([
                    'slug = "hang-quang-chau"'
                    ])->id,
                'status' => Product::STATUS_ENABLE
            ],
            'limit' => 5
        ]);

        $myXuatkhau = Product::find([
            'pcid = :pcid: AND status = :status:',
            'bind' => [
                'pcid' => Category::findFirst([
                    'slug = "hang-xuat-khau"'
                    ])->id,
                'status' => Product::STATUS_ENABLE
            ],
            'limit' => 5
        ]);

        $myThoitrangnuCategory = Category::findFirst([
            'slug = :name: AND status = :status:',
            'bind' => [
                'name' => 'thoi-trang-nu',
                'status' => Category::STATUS_ENABLE
            ]
        ]);
        $children = $myThoitrangnuCategory->children();

        $myCap = Product::find([
            'pcid = :pcid: AND status = :status:',
            'bind' => [
                'pcid' => Category::findFirst([
                    'slug = "thoi-trang-cap"'
                    ])->id,
                'status' => Product::STATUS_ENABLE
            ],
            'limit' => 8
        ]);

        $myHot = Product::find([
            'ishot = :hot: AND status = :status:',
            'bind' => [
                'hot' => Product::IS_HOT,
                'status' => Product::STATUS_ENABLE
            ]
        ]);

        $myNew = Product::find([
            'ishot = :new: AND status = :status:',
            'bind' => [
                'new' => Product::IS_NEW,
                'status' => Product::STATUS_ENABLE
            ]
        ]);

        $this->view->setVars([
            'category' => Category::find([
                'name != "Root" AND level = 2 AND status = ' . Category::STATUS_ENABLE,
                'order' => 'lft'
            ]),
            'aothai' => $myAothai,
            'hangquangchau' => $myQuangchau,
            'hangxuatkhau' => $myXuatkhau,
            'thoitrangnu' => $children,
            'new' => $myNew,
            'hot' => $myHot,
            'thoitrangcap' => $myCap
        ]);

    }
}
