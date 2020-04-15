<h1>{l s='Stores access'}</h1>
<form role="form" action="" method="POST" class="submitSuccess">

    <div class="alert alert-success">
        <button type="button" class="btn btn-sucess"><p aria-hidden="true">&times;</p></button>
        <p>{l s='Manage the stores'}</p>
    </div>

    <div>
        {foreach from=$employees key=$k item=$employee}
            <div class="form-group row">
                <p for="SelectEmployee{$employee['id_employee']}" class="col-sm-2">{$employee['lastname']}{$employee['firstname']}</p>
                <div class="col-sm-6">
                    <select multiple name="EMPLOYEE_{$employee['id_employee']}_STORES[]" class="form-control" id="SelectEmployee{$employee['id_employee']}">
                        {foreach from=$stores item=$store}
                            <option value="{$store['id_store']}" {if isset($employees_select[$employee['id_employee']][$store['id_store']])}selected{/if}>
                                {$store['name']} ({$store['city']} {$store['postcode']})
                            </option>
                        {/foreach}
                    </select>
                </div>
            </div>
            {if $key+1 < (count($employees))}{/if}
            <div class="clearfix"></div>
        {/foreach}
    </div>

    <div class="clearfix"></div>

    <!-- FOOTER -->
        <div class="btn-group">
            <button name="submitSuccess" id="submitSuccess" type="submit" class="btn btn-default">{l s='OK'}</button>
        </div>
</form>