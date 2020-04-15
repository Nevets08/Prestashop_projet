$(document).ready(function () {

    let storeId = null;

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: baseUrl + 'index.php',
        data: {
            fc: 'module',
            module: 'multistore',
            controller: 'check',
            ajax: 1,
            action: 'getStoreUser',
            user_id: userId
        }
    }).done(function(response){
        if(response != false) {
            storeId = response;
            $('#store_'+storeId).attr('checked',true);
        } else {
            $('[name="confirmDelivery"]').addClass('disabled');
        }

        boxHide();
        if ( $('#delivery_option_' + carrierId).is(':checked')) boxShow();
    });

    const boxHide = (a = 500) => {
        $('#store').hide(a);
        $('[name="confirmDelivery"]').removeClass('disabled');
    }
    
    const boxShow = (a = 500) => {
        $('#store').show(a);
        if (storeId == null) {
            $('[name="confirmDelivery"]').addClass('disabled');
        }
    }

    $('[name="confirmDelivery"]').click(function () {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: baseUrl + 'index.php',
            data: {
                module: 'multistore',
                fc: 'module',
                user_id: userId,
                action: 'setUserStore',
                store_id: storeId,
                controller: 'checkout',
                ajax: 1
            }
        })
    });

    $('[id^="delivery_option_"]').click(function() {
        if ($('#delivery_option_' + carrierId).is(':checked')) boxShow();
        else boxHide();
    });
    
    $('[id^="store_"]').click(function() {

        storeId = $('input[name="MULTISTORE_DELIVERY_OPTION"]:checked').val();
        if (storeId != null) {
            $('[name="confirmDelivery"]').removeClass('disabled');
        }
    });


});