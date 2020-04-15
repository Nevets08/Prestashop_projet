<?php

class AdminPDFController extends ModuleAdminController
{
    public function __construct()
    {
        $this->lang = false;
        $this->bootstrap = true;
        parent::__construct();
    }
}