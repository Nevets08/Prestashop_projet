<h1>{l s='Stores registr numbers'}</h1>
<form role="form" action="#" method="POST" id="submitRegistr">
    
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><p aria-hidden="true">&times;</p></button>
        <p>{l s='If needed you can add more stores informations'}</p>
    </div>

    <div>
        {foreach from=$stores key=$k item=$store}
            <div class="form-group row">
                <label for="REGISTR_STORE_{$store['id']}" class="col-sm-3 col-form-label">{$store['name']}<p>{$store['city']} {$store['postcode']}</p></label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="STORE_INFO_{$store['id']}" id="StoreInfos{$store['id']}"
                              {if $k}placeholder="{l s='VAT Number'}: FR 111111111&#10;{l s='SIRET Number'}: 362 521 879 00034"{/if}
                    >{if($stores_info[$store['id']])}{$stores_info[$store['id']]}{/if}</textarea>
                </div>
            </div>
            {if $k+1 < (count($employees))}{/if}
        {/foreach}
    </div>

    <!-- FOOTER -->
        <div class="btn-group">
            <a href="{$stores_link}" class="btn btn-info">{l s='Add/Modify Stores'}</a>
            <button name="submit" type="submit" class="btn btn-default">{l s='OK'}</button>
        </div>
</form>