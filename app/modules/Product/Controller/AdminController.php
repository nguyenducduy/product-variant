<?php
namespace Product\Controller;

use Core\Controller\AbstractAdminController;
use Product\Model\Product;
use Product\Model\Option;
use Product\Model\OptionXGroup;
use Product\Model\OptionGroup;
use Pcategory\Model\Pcategory as ProductCategory;
use Core\Model\Slug;
use Core\Helper\Utilities;
use Core\Model\Image;

/**
 * Product admin home.
 *
 * @category  ThePhalconPHP
 * @author    Nguyen Duc Duy <nguyenducduy.it@gmail.com>
 * @copyright 2014-2015
 * @license   New BSD License
 * @link      http://thephalconphp.com/
 *
 * @RoutePrefix("/admin/product", name="product-admin-home")
 */
class AdminController extends AbstractAdminController
{
    /**
     * number record on 1 page
     * @var integer
     */
    protected $recordPerPage = 30;

    /**
     * Main action.
     *
     * @return void
     *
     * @Route("/", methods={"GET", "POST"}, name="admin-product-index")
     */
    public function indexAction()
    {
        $currentUrl = $this->getCurrentUrl();
        $formData = $jsonData = [];

        if ($this->request->hasPost('fsubmitbulk')) {
            if ($this->security->checkToken()) {
                $bulkid = $this->request->getPost('fbulkid', null, []);

                if (empty($bulkid)) {
                    $this->flash->error($this->lang->_('default.no-bulk-selected'));
                } else {
                    $formData['fbulkid'] = $bulkid;

                    if ($this->request->getPost('fbulkaction') == 'delete') {
                        $coverpath = $category = [];
                        $deletearr = $bulkid;

                        // Start a transaction
                        $this->db->begin();
                        $successId = [];

                        foreach ($deletearr as $deleteid) {
                            $myProducts = Product::findFirst(['id = :id:', 'bind' => ['id' => (int) $deleteid]]);
                            $category[] = $myProducts->pcid;
                            $coverpath[] = $myProducts->image;
                            $coverpath[] = $myProducts->getMediumImage();
                            $coverpath[] = $myProducts->getThumbnailImage();

                            $result = $myProducts->delete();

                            // If fail stop a transaction
                            if ($result == false) {
                                $this->db->rollback();
                                return;
                            } else {
                                $successId[] = $deleteid;
                            }
                        }
                        // Commit a transaction
                        if ($this->db->commit() == true) {
                            // delete cover
                            foreach ($coverpath as $imgpath) {
                                $this->file->delete($imgpath);
                            }

                            foreach ($successId as $productId) {
                                // delete slug
                                Slug::findFirst([
                                    'objectid = :id: AND model = "Product"',
                                    'bind' => ['id' => $productId]
                                ])->delete();

                                // delete image gallaries
                                $myImages = Image::find([
                                    'pid = :pid:',
                                    'bind' => ['pid' => $productId]
                                ]);
                                if ($myImages) {
                                    foreach ($myImages as $img) {
                                        $this->file->delete($img->path);
                                        $this->file->delete($img->getMediumImage());
                                        $this->file->delete($img->getThumbnailImage());
                                        $img->delete();
                                    }
                                }

                                // count down Category
                                foreach ($category as $catId) {
                                    $myCategory = ProductCategory::findFirst($catId);
                                    $myCategory->count = $myCategory->count - 1;
                                    $myCategory->update();
                                }
                            }

                            $this->flash->success(str_replace('###idlist###', implode(', ', $successId), $this->lang->_('default.message-bulk-delete-success')));

                            $formData['fbulkid'] = null;
                        } else {
                            $this->flash->error($this->lang->_('default.message-bulk-delete-fail'));
                        }
                    } else {
                        $this->flash->warning($this->lang->_('default.message-no-bulk-action'));
                    }
                }
            } else {
                $this->flash->error($this->lang->_('default.message-csrf-protected'));
            }
        }

        // Search keyword in specified field model
        $searchKeywordInData = [
            'name'
        ];
        $page = (int) $this->request->getQuery('page', null, 1);
        $orderBy = (string) $this->request->getQuery('orderby', null, 'id');
        $orderType = (string) $this->request->getQuery('ordertype', null, 'asc');
        $keyword = (string) $this->request->getQuery('keyword', null, '');
        // optional Filter
        $id = (int) $this->request->getQuery('id', null, 0);
        $name = (int) $this->request->getQuery('name', null, 0);
        $status = (int) $this->request->getQuery('status', null, 0);
        $datecreated = (int) $this->request->getQuery('datecreated', null, 0);
        $formData['columns'] = '*';
        $formData['conditions'] = [
            'keyword' => $keyword,
            'searchKeywordIn' => $searchKeywordInData,
            'filterBy' => [
                'id' => $id,
                'name' => $name,
                'status' => $status,
                'datecreated' => $datecreated,
            ],
        ];
        $formData['orderBy'] = $orderBy;
        $formData['orderType'] = $orderType;

        $paginateUrl = $currentUrl . '?orderby=' . $formData['orderBy'] . '&ordertype=' . $formData['orderType'];
        if ($formData['conditions']['keyword'] != '') {
            $paginateUrl .= '&keyword=' . $formData['conditions']['keyword'];
        }

        $myProducts = Product::getList($formData, $this->recordPerPage, $page);

        $this->bc->add($this->lang->_('title-index'), 'admin/product');
        $this->bc->add($this->lang->_('title-listing'), '');
        $this->view->setVars([
            'formData' => $formData,
            'myProducts' => $myProducts,
            'recordPerPage' => $this->recordPerPage,
            'bc' => $this->bc->generate(),
            'paginator' => $myProducts,
            'paginateUrl' => $paginateUrl
        ]);
    }

    /**
     * Create action.
     *
     * @return void
     *
     * @Route("/create", methods={"GET", "POST"}, name="admin-product-create")
     */
    public function createAction()
    {
        $formData = [];
        $message = '';

        if ($this->request->hasPost('fsubmit')) {
            // if ($this->security->checkToken()) {
                $formData = array_merge($formData, $this->request->getPost());

                $displayorder = Product::maximum([
                    'column' => 'displayorder'
                ]);

                $myProduct = new Product();
                $myProduct->pcid = (int) $formData['pcid'];
                $myProduct->name = $formData['name'];
                $myProduct->status = $formData['status'];
                $myProduct->displayorder = $displayorder + 1;
                $myProduct->seodescription = $formData['seodescription'];
                $myProduct->seokeyword = $formData['seokeyword'];
                $myProduct->barcode = $formData['barcode'];
                $myProduct->content = $formData['content'];
                $myProduct->vendorprice = $formData['vendorprice'];
                $myProduct->sellprice = $formData['sellprice'];
                $myProduct->discountpercent = $formData['discountpercent'];
                $myProduct->image = $formData['image'];

                if ($myProduct->create()) {
                    // Check product has variant
                    if (count($formData['optiongroup'])) {
                        $countOption = 0;
                        $optArr = [];
                        foreach ($formData['optiongroup'] as $optKey => $optValue) {
                            $optArr[$optKey] = explode(',', $optValue);
                        }

                        $combinations = Utilities::combos($optArr);

                        foreach ($combinations as $com) {
                            // create product option
                            $myOption = new Option();
                            $myOption->pid = $myProduct->id;
                            $myOption->price = $myProduct->sellprice;
                            $myOption->barcode = $myProduct->barcode;
                            $myOption->status = Option::STATUS_ENABLE;

                            if ($myOption->create()) {
                                $countOption++;
                                // create rel option group / option
                                foreach ($com as $optionGroupName => $optionGroupValue) {
                                    $myOptionXGroup = new OptionXGroup();
                                    $myOptionXGroup->poid = $myOption->id;
                                    $myOptionXGroup->pogid = OptionGroup::findFirstByName($optionGroupName)->id;
                                    $myOptionXGroup->value = $optionGroupValue;

                                    if ($myOptionXGroup->create() == false) {
                                        foreach ($myOptionXGroup->getMessages() as $msg) {
                                            $message .= $this->lang->_($msg->getMessage()) . '<br />';
                                        }
                                        $this->flash->error($message);
                                    }
                                }
                            } else {
                                foreach ($myOption->getMessages() as $msg) {
                                    $message .= $this->lang->_($msg->getMessage()) . '<br />';
                                }
                                $this->flash->error($message);
                            }
                        }
                        // update product quantity when available option
                        $myProduct->quantity = $countOption;
                        $myProduct->update();
                    }

                    // update count for Category
                    $myPcategory = ProductCategory::findFirst($myProduct->pcid);
                    $myPcategory->count = $myPcategory->count + 1;
                    $myPcategory->update();

                    // insert to slug table
                    $mySlug = new Slug();
                    $mySlug->assign([
                        'uid' => $this->session->get('me')->id,
                        'slug' => Utilities::slug($formData['name']),
                        'hash' => md5(Utilities::slug($formData['name'])),
                        'objectid' => $myProduct->id,
                        'model' => Slug::MODEL_PRODUCT,
                        'status' => Slug::STATUS_ENABLE
                    ]);
                    if (!$mySlug->create()) {
                        foreach ($mySlug->getMessages() as $msg) {
                            $this->flash->error($msg);
                        }
                    } else {
                        $myProduct->slug = $mySlug->slug;
                        $myProduct->update();
                    }

                    // insert galleries to image table.
                    if (isset($formData['uploadfiles']) && count($formData['uploadfiles']) > 0) {
                        $imageList = array_unique($formData['uploadfiles']);

                        foreach ($imageList as $image) {
                            $path_parts = pathinfo(PUBLIC_PATH . $image);

                            $myImage = new Image();
                            $myImage->assign([
                                'pid' => $myProduct->id,
                                'name' => $myProduct->name,
                                'path' => $image,
                                'filename' => $path_parts['filename'],
                                'basename' => $path_parts['basename'],
                                'extension' => $path_parts['extension'],
                                'size' => $this->file->getSize($image),
                                'status' => Image::STATUS_ENABLE
                            ]);
                            $myImage->create();
                        }
                    }

                    $this->flash->success(str_replace('###name###', $myProduct->name, $this->lang->_('message-create-product-success')));
                } else {
                    foreach ($myProduct->getMessages() as $msg) {
                        $message .= $this->lang->_($msg->getMessage()) . '<br />';
                    }
                    $this->flash->error($message);
                }
            // } else {
            //     $this->flash->error($this->lang->_('default.message-csrf-protected'));
            // }
        }

        $this->bc->add($this->lang->_('title-index'), 'admin/product');
        $this->bc->add($this->lang->_('title-create'), '');
        $this->view->setVars([
            'formData' => $formData,
            'bc' => $this->bc->generate(),
            'statusList' => Product::getStatusList(),
            'categories' => ProductCategory::find(['order' => 'lft']),
            'productOptionGroup' => OptionGroup::find()
        ]);
    }

    /**
     * Edit action.
     *
     * @return void
     *
     * @Route("/edit/{id:[0-9]+}", methods={"GET", "POST"}, name="admin-product-edit")
     */
    public function editAction($id = 0)
    {
        $formData = [];
        $message = '';

        if ($this->request->hasPost('fsubmit')) {
            if ($this->security->checkToken()) {
                $formData = array_merge($formData, $this->request->getPost());
                $myProduct = Product::findFirst([
                    'id = :id:',
                    'bind' => ['id' => (int) $id]
                ]);

                // Delete old image when product change image cover
                if ($formData['image'] != "") {
                    if ($myProduct->image != "" && $myProduct->image != $formData['image']) {
                        $this->file->delete($myProduct->image);
                        $this->file->delete(str_replace('uploads', '', $myProduct->getThumbnailImage()));
                        $this->file->delete(str_replace('uploads', '', $myProduct->getMediumImage()));
                    }
                }

                $myProduct->pcid = (int) $formData['pcid'];
                $myProduct->name = $formData['name'];
                $myProduct->status = $formData['status'];
                $myProduct->seodescription = $formData['seodescription'];
                $myProduct->seokeyword = $formData['seokeyword'];
                $myProduct->barcode = $formData['barcode'];
                $myProduct->content = $formData['content'];
                $myProduct->vendorprice = $formData['vendorprice'];
                $myProduct->sellprice = $formData['sellprice'];
                $myProduct->discountpercent = $formData['discountpercent'];
                $myProduct->image = $formData['image'];

                if ($myProduct->update()) {
                    // insert galleries to image table.
                    if (isset($formData['uploadfiles']) && count($formData['uploadfiles']) > 0) {
                        $imageList = array_unique($formData['uploadfiles']);

                        foreach ($imageList as $image) {
                            $path_parts = pathinfo(PUBLIC_PATH . $image);

                            $myImage = new Image();
                            $myImage->assign([
                                'pid' => $myProduct->id,
                                'name' => $myProduct->title,
                                'path' => $image,
                                'filename' => $path_parts['filename'],
                                'basename' => $path_parts['basename'],
                                'extension' => $path_parts['extension'],
                                'size' => $this->file->getSize($image),
                                'status' => Image::STATUS_ENABLE
                            ]);
                            $myImage->create();
                        }
                    }

                    $this->flash->success(str_replace('###name###', $myProduct->name, $this->lang->_('message-update-product-success')));
                } else {
                    foreach ($myProduct->getMessages() as $msg) {
                        $message .= $this->lang->_($msg->getMessage()) . '<br />';
                    }
                    $this->flash->error($message);
                }
            } else {
                $this->flash->error($this->lang->_('default.message-csrf-protected'));
            }
        }

        /**
         * Find product by id
         */
        $myProduct = Product::findFirst([
            'id = :id:',
            'bind' => ['id' => (int) $id]
        ]);

        $formData = $myProduct->toArray();
        $formData['thumbnailImage'] = $myProduct->getThumbnailImage();

        // Get gallery
        $formData['imageList'] = [];
        $myImages = Image::find([
            'pid = :productId:',
            'bind' => ['productId' => (int) $id]
        ]);

        if ($myImages) {
            foreach ($myImages as $image) {
                $formData['imageList'][] = [
                    'name' => $image->basename,
                    'path' => $image->path,
                    'size' => $image->size
                ];
            }
            $formData['imageList'] = (string) json_encode($formData['imageList']);
        }

        $this->bc->add($this->lang->_('title-index'), 'admin/product');
        $this->bc->add($this->lang->_('title-edit'), '');
        $this->view->setVars([
            'formData' => $formData,
            'bc' => $this->bc->generate(),
            'statusList' => Product::getStatusList(),
            'categories' => ProductCategory::find(['order' => 'lft']),
            'id' => $id
        ]);
    }

    /**
     * Delete product action.
     *
     * @return void
     *
     * @Get("/delete/{id:[0-9]+}", name="admin-product-delete")
     */
    public function deleteAction($id = 0)
    {
        $message = '';
        $myProduct = Product::findFirst(['id = :id:', 'bind' => ['id' => (int) $id]]);

        // update count for Category
        $myPcategory = ProductCategory::findFirst($myProduct->pcid);
        $myPcategory->count = $myPcategory->count - 1;
        $myPcategory->update();

        // delete slug
        Slug::findFirst([
            'objectid = :id: AND model = "Product"',
            'bind' => ['id' => $myProduct->id]
        ])->delete();

        // delete cover
        if ($myProduct->image != "") {
            $this->file->delete($myProduct->image);
        }

        // delete images gallery if exist
        $myImages = Image::find([
            'pid = :pid:',
            'bind' => [
                'pid' => $myProduct->id
            ]
        ]);
        if ($myImages) {
            foreach ($myImages as $img) {
                $this->file->delete($img->path);
                // delete in db
                $img->delete();
            }
        }

        if ($myProduct->delete()) {
            $this->flash->success(str_replace('###id###', $id, $this->lang->_('message-delete-success')));
        } else {
            foreach ($myProduct->getMessages() as $msg) {
                $message .= $this->lang->_($msg->getMessage()) . "</br>";
            }
            $this->flashSession->error($message);
        }

        return $this->response->redirect('admin/product');
    }

    /**
     * Upload image gallery action.
     *
     * @return void
     *
     * @Post("/uploadimage", name="admin-product-uploadimage")
     */
    public function uploadimageAction()
    {
        $meta = $result = [];
        $myImage = new Image();
        $upload = $myImage->processUpload();

        if ($upload == $myImage->isSuccessUpload()) {
            $meta['status'] = true;
            $meta['message'] = 'File uploaded!';
            $result = $myImage->getInfo();
        } else {
            $meta['success'] = false;
            $meta['message'] = $myImage->getMessage();
        }

        $this->view->setVars([
            '_meta' => $meta,
            '_result' => $result
        ]);
    }

    /**
     * Edit and save image action.
     *
     * @return void
     *
     * @Post("/editimage", name="admin-product-editimage")
     */
    public function editimageAction()
    {
        $meta = $result = [];
        $imageData = Utilities::base64Image($this->request->getPost('imgData', null, ''));
        $productId = $this->request->getPost('productId', null, 0);

        $myProduct = Product::findFirst([
            'id = :productId:',
            'bind' => [
                'productId' => (int) $productId
            ]
        ]);

        $imageUrl = $myProduct->image;

        if ($myProduct) {
            if ($this->file->put($imageUrl, $imageData) == true) {
                $myProduct->resizeImage();
                $meta['success'] = true;
                $meta['message'] = 'Image saved OK!';
            }
        } else {
            $meta['success'] = false;
            $meta['message'] = 'Product not Found!';
        }

        $this->view->setVars([
            '_meta' => $meta,
            '_result' => $result
        ]);
    }

    /**
     * Delete image gallery action.
     *
     * @return void
     *
     * @Post("/deleteimage", name="admin-product-deleteimage")
     */
    public function deleteimageAction()
    {
        $meta = $result = [];
        $deleted = false;
        $fileName = $this->request->getPost('name');
        $isEdit = $this->request->getPost('edit', null, 0);

        if ($isEdit > 0) {
            $myImage = Image::findFirst([
                'basename = :name:',
                'bind' => ['name' => $fileName]
            ]);
            if ($myImage) {
                $this->file->delete($myImage->path);
                $this->file->delete($myImage->getMediumImage());
                $this->file->delete($myImage->getThumbnailImage());
                $myImage->delete();
                $meta['status'] = true;
                $meta['message'] = 'File removed!';
            } else {
                $meta['success'] = false;
                $meta['message'] = 'Image file not found!!!';
            }
        } else {
            $arrayToDelete = $this->session->get($fileName);
            foreach ($arrayToDelete as $path) {
                if ($this->file->delete($path)) {
                    $deleted = true;
                }
            }

            if ($deleted) {
                $meta['status'] = true;
                $meta['message'] = 'File removed!';
                $result = $arrayToDelete[0];
            } else {
                $meta['success'] = false;
                $meta['message'] = 'Error occurred when delete uploaded file!!!';
            }
        }

        $this->view->setVars([
            '_meta' => $meta,
            '_result' => $result
        ]);
    }

    /**
     * Inline update hot product.
     *
     * @return void
     *
     * @Post("/inlineupdate", name="admin-product-updatehot")
     */
    public function inlineupdateAction()
    {
        $field = $this->request->getPost('name', null, "");
        $productId = $this->request->getPost('pk', null, 0);
        $value = $this->request->getPost('value', null, 0);
        $meta = $result = [];

        $myProduct = Product::findFirst([
            'id = :productId:',
            'bind' => [
                'productId' => (int) $productId
            ]
        ]);

        if ($myProduct) {
            $myProduct->$field = (int) $value;
            if ($myProduct->update()) {
                $meta['status'] = true;
                $meta['message'] = 'Updated!';
            } else {
                $meta['success'] = false;
                $meta['message'] = 'Update failed!';
            }
        } else {
            $meta['success'] = false;
            $meta['message'] = 'Product not found!';
        }

        $this->view->setVars([
            '_meta' => $meta
        ]);
    }

    /**
     * Show / Edit variant.
     *
     * @return void
     *
     * @Get("/showvariant", name="admin-product-showvariant")
     */
    public function showvariantAction()
    {
        $meta = $result = $_thead_option = $_thead = [];

        $productId = (int) $this->request->getQuery('id', null, 0);
        $myOptions = Option::find([
            'pid = :pid:',
            'bind' => [
                'pid' => $productId
            ]
        ]);
        if ($myOptions) {
            $productOptions = [];
            foreach ($myOptions as $optionItem) {
                $variants = OptionXGroup::findByPoid($optionItem->id);
                $opt = [];
                if ($variants) {
                    $optAttr = [];
                    foreach ($variants as $var) {
                        $myOptionGroup = OptionGroup::findFirstById($var->pogid);
                        $optAttr[strtolower($myOptionGroup->name)] = $var->value;
                        $_thead_option[] = $var->pogid;
                    }
                    $opt += $optAttr;
                }

                $imageurl = "";
                if ($optionItem->image != "") {
                    $imageurl = $this->url->getStaticBaseUri() . $optionItem->getThumbnailImage();
                }

                $opt += [
                    'id' => $optionItem->id,
                    'quantity' => $optionItem->quantity,
                    'barcode' => $optionItem->barcode,
                    'image' => $imageurl,
                    'price' => number_format($optionItem->price)
                ];

                $productOptions[] = $opt;
            }
        }

        // Render thead
        $_thead_unique = array_unique($_thead_option, SORT_NUMERIC);
        asort($_thead_unique);
        foreach ($_thead_unique as $optionGroupId) {
            $_thead[] = strtolower(OptionGroup::findFirstById($optionGroupId)->name);
        }

        $result['thead'] = $_thead;
        $result['trow'] = $productOptions;

        $this->view->setVars([
            '_meta' => $meta,
            '_result' => $result
        ]);
    }

    /**
     * Edit variant action.
     *
     * @return void
     *
     * @Route("/editvariant", methods={"POST"}, name="admin-product-editvariant")
     */
    public function editvarianAction()
    {
        $field = $this->request->getPost('name', null, "");
        $variantId = $this->request->getPost('pk', null, 0);
        $value = $this->request->getPost('value', null, 0);
        $meta = $result = [];

        $myOption = Option::findFirst([
            'id = :variantId:',
            'bind' => [
                'variantId' => (int) $variantId
            ]
        ]);

        $myOptionGroup = OptionGroup::find();
        $optionGroupArray = [];
        foreach ($myOptionGroup as $og) {
            $optionGroupArray[] = strtolower($og->name);
        }

        if (in_array($field, $optionGroupArray)) {
            //Check exist option group
            $existed = OptionXGroup::checkVariant($myOption, $field, $value);

            if ($existed) {
                $meta['status'] = false;
                $meta['message'] = 'Variant existed!';
            } else {
                // get option group id
                $myOptionGroup = OptionGroup::findFirst([
                    'name = :field:',
                    'bind' => [
                        'field' => ucfirst($field)
                    ]
                ]);
                $myOptionXGroup = OptionXGroup::findFirst([
                    'poid = :poid: AND pogid = :pogid:',
                    'bind' => [
                        'poid' => $myOption->id,
                        'pogid' => $myOptionGroup->id
                    ]
                ]);
                if ($myOptionXGroup) {
                    $myOptionXGroup->value = $value;
                    if ($myOptionXGroup->update()) {
                        $meta['status'] = true;
                        $meta['message'] = 'Updated!';
                    } else {
                        $meta['success'] = false;
                        $meta['message'] = 'Update failed!';
                    }
                } else {
                    $meta['success'] = false;
                    $meta['message'] = 'Variant not found!';
                }
            }
        } else {
            if ($myOption) {
                if ($field == 'price') {
                    $value = str_replace(',', "", $value);
                }
                $myOption->$field = $value;
                if ($myOption->update()) {
                    if ($field == 'quantity') {
                        // update total quantity
                        $totalProduct = Option::sum([
                            'column' => 'quantity',
                            'condition' => 'pid = ?0',
                            'bind' => [$myOption->pid]
                        ]);

                        $myProduct = Product::findFirstById($myOption->pid);
                        $myProduct->quantity = (int) $totalProduct;
                        if ($myProduct->update()) {
                            $result['pid'] = (int) $myProduct->id;
                            $result['totalProduct'] = (int) $totalProduct;
                        }
                    }

                    $meta['status'] = true;
                    $meta['message'] = 'Updated!';
                } else {
                    $meta['success'] = false;
                    $meta['message'] = 'Update failed!';
                }
            } else {
                $meta['success'] = false;
                $meta['message'] = 'Variant not found!';
            }
        }

        $this->view->setVars([
            '_meta' => $meta,
            '_result' => $result
        ]);
    }

    /**
     * Upload image option action.
     *
     * @return void
     *
     * @Post("/uploadoptionimage", name="admin-product-uploadoptionimage")
     */
    public function uploadoptionimageAction()
    {
        $meta = $result = [];
        $myOption = new Option();
        $upload = $myOption->processUpload();

        if ($upload == $myOption->isSuccessUpload()) {
            $meta['status'] = true;
            $meta['message'] = 'File uploaded!';
            $result = $myOption->getInfo();
        } else {
            $meta['success'] = false;
            $meta['message'] = $myOption->getMessage();
        }

        $this->view->setVars([
            '_meta' => $meta,
            '_result' => $result
        ]);
    }

    /**
     * update image path to option table.
     *
     * @return void
     *
     * @Post("/updateoptionimage", name="admin-product-updateoptionimage")
     */
    public function updateoptionimageAction()
    {
        $meta = $result = [];
        $myOption = Option::findFirst([
            'id = :optionId:',
            'bind' => [
                'optionId' => $this->request->getPost('id', null, 0)
            ]
        ]);

        $myOption->image = $this->request->getPost('path', null, '');

        if ($myOption->update()) {
            $meta['status'] = true;
            $meta['message'] = 'Option updated!';
        } else {
            $meta['success'] = false;
            $meta['message'] = 'Option update failed!';
        }

        $this->view->setVars([
            '_meta' => $meta
        ]);
    }

    /**
     * Delete option image action.
     *
     * @return void
     *
     * @Post("/deleteoptionimage", name="admin-user-deleteoptionimage")
     */
    public function deleteoptionimageAction()
    {
        $meta = $result = [];
        $deleted = false;
        $optionId = $this->request->getPost('id');
        $myOption = Option::findFirst([
            'id = :optionId:',
            'bind' => [
                'optionId' => $this->request->getPost('id', null, 0)
            ]
        ]);

        $arrayToDelete = [
            $myOption->image,
            $myOption->getThumbnailImage(),
            $myOption->getMediumImage(),
        ];

        foreach ($arrayToDelete as $path) {
            // if remove from database replace "uploads" string
            if ($this->file->delete(str_replace('uploads', '', $path))) {
                $deleted = true;
            }
        }

        if ($deleted) {
            // update option image field to blank
            $myOption->image = "";
            $myOption->update();

            $meta['status'] = true;
            $meta['message'] = 'File removed!';
            $result = $arrayToDelete[0];
        } else {
            $meta['success'] = false;
            $meta['message'] = 'Error occurred when delete uploaded file!!!';
        }

        $this->view->setVars([
            '_meta' => $meta,
            '_result' => $result
        ]);
    }
}
