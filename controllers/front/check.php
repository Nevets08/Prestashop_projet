php

class MultistoreCheckFrontController extends ModuleFrontController
{
    public function startContent() {
        parent::startContent();
        $this->setTemplate('module:multistore/views/templates/front/check.tpl');
    }

    public function displayAjaxCreateUserStore()
    {
        $user = Tools::getValue('user_id');
        $store = Tools::getValue('store_id');
        $sql = 'REPLACE INTO '._DB_PREFIX_.'multistore_checkout SET `customer_id` = '.$user.', `store_id` = '.$store;
        Db::getInstance()->execute($sql);
        $this->ajaxDie(json_encode(true));
    }
}

    public function displayAjaxFindUserStore()
    {
        $user = Tools::getValue('user_id');
        $sql = 'SELECT `store_id` FROM '._DB_PREFIX_.'multistore_check WHERE `customer_id` = '.$user;
        $return = Db::getInstance()->getValue($sql);
        $this->ajaxDie(json_encode($return));
    }