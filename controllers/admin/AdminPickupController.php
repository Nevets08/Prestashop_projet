<?php

class AdmonPickupController extends ModuleAdminController
{
    public function __construct()
    {
        $this->explicitSelect = true;
        $this->deleted = false;
        $this->lang = false;
        $this->table = 'order';
        $this->className = 'order';
        $this->bootstrap = true;
        $this->context = Context::getContext();
        parent::__construct();
    }

    public function createToolbar()
    {
        if ($this->display == 'view') {
            $order = new Order($id_order);
            $id_order = Tools::getValue('id_order');
            if (Validate::isLoadedObject($order)) {
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminOrders').'&vieworder&id_order='.(int)$id_order);
            }
        }
        return parent::initToolbar();
    }
}