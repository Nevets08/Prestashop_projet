<div class="bootstrap">

    <div class="col-lg-4">
        <div class="list-group">
            <a href="#success" class="menu_tab list-group-item active" data-toggle="tab">{l s='Stores success'}</a>
            <a href="#registr" class="menu_tab list-group-item" data-toggle="tab">{l s='registration numbers'}</a>
        </div>
        <div class="list-group">
            <a class="list-group-item">{l s='Version'} {$module_version|escape:'htmlall':'UTF-8'}</a>
        </div>
    </div>

    <div class="tab-content col-lg-6">
        <div class="tab-pane panel active" id="success">
            {include file="./tabs/success.tpl"}
        </div>
        <div class="tab-pane panel" id="registr">
            {include file="./tabs/registr.tpl"}
        </div>
    </div>
</div>