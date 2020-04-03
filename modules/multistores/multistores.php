<?php

// sécurité de base
if (!defined('_PS_VERSION_')){
    exit;
}

class MultiStores extends Module {
    
    public function __construct()
    {
        // Créer les informations de base du module
        // le nom
        $this->name = 'multistores';
        // Nom d'affichage dans le BO (BackOffice)
        $this->displayName = $this->l('Multi Stores');
        // Tabulation - en gros equivalent catégorie de module
        $this->tab = 'front_office_features';
        // Version du module
        $this->version = '1.0.0';
        // Auteur
        $this->author = 'Steven ROBERT';
        // Description du module
        $this->description = $this->l('Desciption a faire en anglais');
        // Compatibilité de votre module
        $this->ps_versions_compliancy =['min' => '1.6', 'max' => _PS_VERSION_];
        // Confirmation de la suppression
        $this->confirmUninstall = $this->l('Are you sure ?');

        // Compatibilité 1.6
        $this->bootstrap = true;

        // On fait appel au parent
        parent::__construct();
    }

    public function install() {
        
        // On se greffe sur un ou plusieurs hooks
        if (!parent::install()
/*            || !$this->registerHook('displayFooterProduct')
            || !$this->registerHook('displayProductActions')
            || !$this->registerHook('displayLeftColumn')
            || !$this->registerHook('displayHeader')

            // On installe le menu
            || !$this->_installTab(0,'AdminFirstModule', $this->l('My First Module'))
            || !$this->_installTab('AdminFirstModule','AdminFirstModuleList', $this->l('List'))

            // On installe les tables SQL
            || !$this->_installSql() */
        ){
            return false;
        }
        return true;
    }

    public function uninstall() {
        if (!parent::uninstall()

        /* On supprime le/les menu(s) et sous-menu(s) 
        || !$this->_uninstallTab('AdminFirstModule')
        || !$this->_uninstallTab('AdminFirstModuleList') */
        
        ){
            return false;
        }
        return true;
    }

}