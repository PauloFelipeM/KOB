/**/
//SAFE
document.addEventListener("DOMContentLoaded", function() {
  $('#scheduled_date').datepicker({});
});
/**/

//Cant submit via enter key
$('form input'). keydown(function (e) {
    if (e. keyCode == 13) {
    e. preventDefault();
    return false;
    }
});

//Start default values
$('#number_hours').val(0);
$('#amount').val(0);

$('#service_type').on('change', function(event){
    value = event.target.value;  
    $('#amount').val(0);      
    if(value == 1){
        $('#number_hours_div').css('display', 'none');
        $('#number_hours').val(0);
    }else if(value == 2){
        $('#number_hours_div').css('display', 'block');
        $('#number_hours').val(1);
    }
})

//Show UP comments
$('#checkbox_additional_commments').on('change', function(event){              
    checked = event.target.checked;
    if(checked){
        $('#additional_commments_div').css('display', 'block');
    }else{
        $('#additional_commments_div').css('display', 'none');
    }
});   

function check_number_hours(value){
    if(value > 100 || value < 1){
        $('#number_hours').val(1);
    }
}