$(document).ready(function(){
    $('.menu_tab').click(function()
    {
        $('.tab-pane').removeClass('active');
        $(this).addClass('active');
        $('.menu_tab').removeClass('active');
    });
});