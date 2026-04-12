changeTipoCargo();

function changeTipoCargo()
{
    $('#nro_item').prop('disabled', true);
    if ($('#tipo_cargo').val() == 'ITEM')
    {
        $('#nro_item').prop('disabled', false);
    }
    else
    {
        $('#nro_item').prop('disabled', true);
    }
}