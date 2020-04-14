
<div id="multistores">
    <h2 class="step-title h2 mb-1">
        {$title}
    </h2>
    <div class="form-fields">
        <div class="delivery-options">
            {foreach from=$stores item=$store}
                <div class="row delivery-options">
                    <div class="col-sm-1">
                      <span class="custom-radio float-xs-left">
                        <input type="radio" name="MULTISTORE_DELIVERY_OPTIONS" id="multi_store_{$store['id_store']}"
                               value="{$store['id_store']}">
                      </span>
                    </div>
                    <label for="multi_store_{$store['id_store']}" class="col-sm-11 delivery-options2">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <span class="h3 carrier-name">{$store['name']}</span><br>
                                        <img src="{$store['image']['url']['small']}" alt="{$store['image']['legend']}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 col-xs-12">
                                <span class="carrier-delay">
                                    {$store['address1']}<br>
                                    {$store['address2']}<br>
                                    {$store['city']} {$store['postcode']} <br>
                                </span>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <span class="carrier-price">
                                    <a href="https://www.google.com/maps/search/?api=1&query={$store['latitude']},{$store['longitude']}"
                                       target="_blank">Google Maps</a><br>
                                </span>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="clear"></div>
            {/foreach}
        </div>
    </div>

</div>
