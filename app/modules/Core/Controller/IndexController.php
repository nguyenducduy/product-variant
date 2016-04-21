<?php
namespace Core\Controller;

/**
 * Error handler.
 *
 * @category  ThePhalconPHP
 * @author    Nguyen Duc Duy <nguyenducduy.it@gmail.com>
 * @copyright 2014-2015
 * @license   New BSD License
 * @link      http://thephalconphp.com/
 *
 * @RoutePrefix("/admin", name="admin-dashboard-home")
 */
class IndexController extends AbstractAdminController
{
    /**
     * Core not found page.
     *
     * @return void
     *
     * @Get("/", name="core-admin-index")
     */
    public function indexAction()
    {
        $this->response->setStatusCode('404', 'Page not found');
    }

    /**
     * Admin dashboard.
     *
     * @return void
     *
     * @Get("/dashboard", name="core-admin-dashboard")
     */
    public function dashboardAction()
    {
        $this->bc->add($this->lang->_('title-dashboard'), 'admin/dashboard');
        $this->view->setVars([
            'bc' => $this->bc->generate()
        ]);
    }
}
