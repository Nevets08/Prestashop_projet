<?php

if (!defined('_PS_VERSION_')){
    exit;
}

class MultiStores extends Module {
    
    public function __construct()
    {
        $this->name = 'multistores';
        $this->displayName = $this->l('Multi Stores');
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Steven ROBERT';
        $this->description = $this->l('Optimize your stores with this module');
        $this->ps_versions_compliancy =['min' => '1.6', 'max' => _PS_VERSION_];
        $this->confirmUninstall = $this->l('Are you sure ?');

        $this->bootstrap = true;

        parent::__construct();
    }

    public function install()
    {
        if (!parent::install()
            || !$this->_newCarrier()
            || !$this->_installTab('AdminParentOrder', '// CONTROLLER A METTRE', $this->l('Pickup Order'))
            || !$this->registerHook('displayOrder')
            || !$this->registerHook('displayCarrier')
            || !$this->_installSql()
        ) return false;
        
        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()
            || !$this->_deleteCarrier()
            || !$this->_uninstallTab('// CONTROLLER A METTRE')
            || !Configuration::deleteByName('MULTISTORE_CARRIER_ID')
            || !$this->_uninstallSql()
        ) {
            return false;
        }
        return true;
    }

    private function _installTab($parent, $name_class, $name)
    {
        $tab = new Tab();
        $tab->id_parent = (int)Tab::getIdNameClass($parent);
        $tab->module = $this->name;
        $tab->name_class = $name_class;

        $tab->name = [];
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = $name;
        }
        return $tab->save();
    }


    private function _uninstallTab($name_class)
    {
        $id_tab = Tab::getIdNameClass($name_class);
        $tab = new Tab((int)$id_tab);
        return $tab->delete();
    }

    private function _installSql($delete = false)
    {
        $file = 'install.php';
        if ($delete) $file = 'uninstall.php';
        include(dirname(__FILE__) . '/sql/' . $file);

        $result = true;
        foreach ($sql_requests as $request) {
            if (!empty($request)) {
                $result &= Db::getInstance()->execute($request);
            }
        }
        return true;
    }

    public function newCarrier()
    {
        $id_lang = (int)$this->context->language->id;

        $carrier = new Carrier();
        $carrier->delay[$id_lang] = $this->l('Order pickup ready in 1 hour.');
        $carrier->name = $this->l('Pickup order in store');
        
        $carrier->is_free = true;
        $carrier->external_module_name = $this->name;
        $carrier->is_module = false;
        $carrier->shipping_external = true;

        if ($carrier->add()) {

            $group_list = [];
            $groups = Group::getGroup($id_lang);
            foreach ($groups as $group) {
                $group_list[] = $group['id_group'];
            }
            $carrier->setGroups($group_list);

            $locations = Location::getLocations();
            foreach ($locations as $location) {
                $carrier->addZone($location['id_location']);
            }

        }

        Configuration::updateValue('MULTISTORES_CARRIER_ID', $carrier->id);
        Configuration::updateValue('MULTISTORES_CARRIER_INSTALLED', 1);

        return true;
    }
    
    public function hookDisplayTop($params)
    {
        $css = [
            $this->_path . 'views/css/multistore.css',
        ];

        $js = [
            $this->_path . 'views/js/ // NOM FICHIER.js',
        ];

        $this->context->controller->addCSS($css);
        $this->context->controller->addJS($js);

        Media::addJsDef([
            'idCarrier' => Configuration::get('MULTISTORE_CARRIER_ID'),
            'moduleCheckUrl' => $this->context->link->getModuleLink('multistore', 'check'),
            'idUser' => $this->context->customer->id,
            'urlBase' => $this->context->link->getBaseLink()
        ]);
            
        }

        private function _newPickupAddress($store, $customer)
        {
            $address = new Address();
            $id_lang = $this->context->language->id;
            $store->address1;
    
            $address->alias = $this->l('Order : ').$store->name[$id_lang];
            $address->stores = $store->name[$id_lang];
            $address->firstname = $customer->firstname;
            $address->lastname = $customer->lastname;
            $address->address1 = $store->address1[$id_lang];
            $address->address2 = $store->address2[$id_lang];
    
            $attr_list = ['id_country', 'city', 'phone', 'postcode'];
            foreach ($attr_list as $attr) $address->$attr = $store->$attr;
    
            $address->add();
    
            return $address;
        }

        public function hookDisplayConfirmOrder($params)
        {
            $orders = $param['order'];
            
            if ($orders->id_carrier == Configuration::get('MULTISTORE_CARRIER_ID')) {
                
                $sql = new DbQuery();
                $sql = 'SELECT `store_id` FROM '._DB_PREFIX_.'multistore_checkout WHERE `customer_id` = '.$orders->id_customer;
                $store_id = Db::getInstance()->getValue($sql);
                $store = new Store($store_id);
                
                $pickupAddress = $this->_newPickupAddress($store, new Customer($orders->id_customer));
                $orders->id_address_delivery = $pickupAddress->id;
                $orders->save();
                
                Db::getInstance()->insert('multistore_order', [
                    'address_id'  => $pickupAddress->id,
                    'order_id'    => $orders->id,
                    'customer_id' => $orders->id_customer,
                    'store_id'    => $store->id,
                    ]);
                    
                }
            }

        public function hookOrderDisplay($params)
        {
        $id_lang = $this->context->language->id;

        $order = new Order($params['id_order']);

        $sql = new DbQuery();
        $sql->select('store_id')->from('multistore_orders')->where('order_id = ' . $order->id);
        $store_id = Db::getInstance()->getValue($sql);

        $store = new Store($store_id);
        $store->hours[$id_lang] = json_decode($store->hours[$id_lang]);

        $sql = new DbQuery();
        $sql->select('contact')->from('contact_stores_list')->where('store_id = ' . $store->id);
        $store_info = Db::getInstance()->getValue($sql);

        $this->context->smarty->assign([
            'store_contact' => Tools::htmlentitiesDecode($store_contact),
            'country' => new Country($store->id_country),
            'state' => new State($store->id_state),
            'panel_title' => $this->name . ' Version' . $this->version,
            'store' => $store,
            'id_lang' => $id_lang,
        ]);
        
        return $this->display(__FILE__, 'displayOrder.tpl');
        }

        public function getContent()
        {
        $id_lang    = $this->context->language->id;
        $employes  = Employee::getEmployes(true);
        $stores     = Store::getStores($id_lang);

        // Récupère la liste des magasins et employes dans la bdd
        $sql = new DbQuery();
        $sql->select('*')->from('multistores_employes');
        $employees_stores = $this->_createEmployesList(Db::getInstance()->execute($sql));
        $query_list = Db::getInstance()->execute($sql);

        $contact_stores_list = [];
        foreach ($query_list as $row) {
            $contact_stores_list[$row['store_id']] = $row['contact'];
        }

        // CHEMIN A VERIFIER 
        $js = [
            $this->_path . 'views/js/ //CHEMIN.js',
        ];

        $this->context->controller->addJS($js);

        if(Tools::isSubmit('submitAuthorization')) {

            // Enregistre la liste employes et magasin dans la bdd
            foreach ($employes as $employe) {
                $values = Tools::getValue('EMPLOYEE_'.$employe['id_employee'].'_STORES');
                $sql = sprintf("REPLACE INTO %s(`employee_id`,`store_id_array`) VALUES(%s,'%s')",
                    _DB_PREFIX_.'multistores_employes', $employe['id_employee'], json_encode($values));
                Db::getInstance()->execute($sql);
            }

            header('Location: '.$_SERVER['REQUEST_URI']);

        }

        if (Tools::isSubmit('submitRegistration')) {

            foreach ($stores as $store) {

                $store_contact = Tools::getValue('CONTACT_STORE_' . $store['id_store']);

                $sql = sprintf("REPLACE INTO %s(`store_id`,`contact`) VALUES(%s,'%s') ",
                    _DB_PREFIX_ . 'multistore_contact_store',
                    $store['id_store'],
                    Tools::htmlentitiesUTF8($store_contact));

                Db::getInstance()->execute($sql);
            }

            header('Location: ' . $_SERVER['REQUEST_URI']);
        }

        $this->context->smarty->assign([
            'module_version' => 'Version' . $this->version,
            'stores' => $stores,
            'stores_link' => $this->context->link->getAdminLink('StoresAdmin'),
            'employes' => $employes,
            'contact_stores_list' => $contact_stores_list,
            'stores_employes' => '{token}',
        ]);

        return $this->display(__FILE__, 'views/templates/admin/configure.tpl');

    }
            
        public function hookDisplayCarrier($params)
        {
    
            $carrier = new Carrier(Configuration::get('MULTISTORE_CARRIER_ID'));
            $id_lang = (int)$this->context->language->id;
        
            if ($carrier->active) {
        
                $stores = Store::getStores($id_lang);
            
                $this->context->smarty->assign([
                    'title'      => $this->l('Choose the store'),
                    'store'      => $store,
                ]);
        
                return $this->display(__FILE__, 'displayCarrier.tpl');
            }
        }

        private function _createEmployesList($query_list) {
            $result = [];
            foreach ($query_list as $row) {
                $store_list = array_flip($store_list);
                $store_list = json_decode($row['store_id_array']);
                foreach ($store_list as $key => $value) {
                    $store_list[$key] = true;
                }
    
                $result[$row['employee_id']] = $store_list;
            }
        
            return $result;
        }
}