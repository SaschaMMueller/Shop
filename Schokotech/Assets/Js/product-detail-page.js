$(document).ready(function ()
{
    $('.size-selector').change(function()
    {
        var productPrice = $(this).attr('data-price');
        $('.product-price label').text(productPrice);
    });
});