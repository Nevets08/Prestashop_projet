
<div>
    <div class="title">
            <span>{$title}</span>
        </div>

        <div class="row">
            <div class="col-xs-4">
                <h2>{l s='Address' mod='multistores'}</h2>
                <p>
                    <img class="img-thumbnail rounded" src="{$store_image['large']['url']}"/>
                </p>
                <p>
                    {$store->name[$id_lang]}<br>
                    {$store->address1[$id_lang]}<br>
                    {$store->address2[$id_lang]}
                </p>
                <p>
                    {$country->name[$id_lang]} {$state->name[$id_lang]}
                    {$store->city} {$store->postcode} <br>
                 </p>
            </div>
            <div class="col-xs-4">
                <ul>
                    <li><h2>Contact information</h2></li> 
                    <li>Email</dt>
                    <li><a href="mailto:{$store->email}"> {$store->email}</a></li>

                    <li>Phone number</li>
                    <li><a href="tel:{$store->phone}"> {$store->phone}</a></li>

                    <li>{l s='SIRET' mod='multistores'}</li>
                    <li>62 521 879 00034</li>

                    <li>{l s='VAT' mod='multistores'}</li>
                    <li>46034861</li>
                </ul>
            </div>
            <div class="col-xs-4">
                <ul>
                    <li><h2>{l s='hours' mod='multistores'}</h2></li>
                    <li>{l s='Monday' mod='multistores'}</li>
                    <li>{$store->hours[$id_lang][0]}</li>
                    <li>{l s='Tuesday' mod='multistores'}</li>
                    <li>{$store->hours[$id_lang][0]}</li>
                    <li>{l s='Wednesday' mod='multistorse'}</li>
                    <li>{$store->hours[$id_lang][0]}</li>
                    <li>{l s='Thursday' mod='multistores'}</li>
                    <li>{$store->hours[$id_lang][0]}</li>
                    <li>{l s='Friday' mod='multistores'}</li>
                    <li>{$store->hours[$id_lang][0]}</li>
                    <li>{l s='Saturday' mod='multistores'}</li>
                    <li>{$store->hours[$id_lang][0]}</li>
                    <li>{l s='Sunday' mod='multistores'}</li>
                    <li>{$store->hours[$id_lang][0]}</li>
                </ul>
            </div>
        </div>

    </div>
</div>
