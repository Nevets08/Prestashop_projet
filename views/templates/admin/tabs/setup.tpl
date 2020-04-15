<h1>{l s='store access' mod='firstmodule'}</h1>
<form role="form" action="" method="POST" id="submitSetup" name="form">

    <div>
        <div class="row">
            <div class="col-xs-8">
                <div class="form-group">
                    <label class="control-label col-lg-4" for="name">
                        <span class="label-tooltip" data-toggle="tooltip" title="Enter your name here">
                            {l s='name'}
                        </span>
                    </label>
                    <div class="col-lg-9">
                        <div class="input-group">
                            <input type="text" name="name" id="name">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-xs-6">

            </div>
        </div>
    </div>


    <div class="clearfix"></div>

    <!-- FOOTER -->
    <div class="panel-footer">
        <div class="btn-group pull-right">
            <button name="submitParameters" id="submitParameters" type="submit" class="btn btn-default">
                <i class="process-icon-save"></i>
                {l s='Save'}
            </button>
        </div>
    </div>


</form>