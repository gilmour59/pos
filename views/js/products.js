//Load Dynamic Datatable (test)
/* $.ajax({

    url: "ajax/datatable-products.ajax.php",
    success: function(response){
        console.log("response", response);
    }
}); */

//Load Dynamic Datatable
$('#products_table').DataTable({
    "ajax" : "ajax/datatable-products.ajax.php",
    "deferRender" : true,
    "retrieve" : true,
    "processing" : true
});

//select 1st option in category
$(document).on('click', '#btn-add-product', function(){

    //This is for the checked percentage
    $('#addSellPrice').prop("readonly", true);
    
    var category_id = $('#addCategoryProduct').val();

    var data = new FormData();
    data.append("category_id", category_id);

    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,   
        dataType: "json",     
        success: function(request){
            //if new category is made
            if(!request){
                var new_code = category_id + "01";
                $('#addCode').val(new_code);
            }else{
                var new_code = Number(request["code"]) + 1;
                $('#addCode').val(new_code);
            }            
        }
    });
});

//When Category is changed in Add modal
$(document).on('change', '#addCategoryProduct', function(){

    var category_id = $(this).val();

    var data = new FormData();
    data.append("category_id", category_id);

    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,   
        dataType: "json",     
        success: function(request){       
            //if new category is made
            if(!request){
                var new_code = category_id + "01";
                $('#addCode').val(new_code);
            }else{
                var new_code = Number(request["code"]) + 1;
                $('#addCode').val(new_code);
            }            
        }
    });
});

//Edit Products
$(document).on('click', '.btn-edit-product', function(){

    var productId = $(this).attr('data-product-id');
    
    var data = new FormData();
    data.append("productId", productId);

    $.ajax({

        url: "ajax/products.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(request){
            //$('#editCategory').val(request["category"]);

            //$('#productId').val(request["id"]);            
        }
    });
});

//Adding Selling Price
$('#addBuyPrice').change(function(){

    if($('.percentage').prop("checked")){

        $('#addSellPrice').prop("readonly", true);
        
        var percentage_value = $('.newPercentage').val();
        var percentage = Number(($('#addBuyPrice').val() * percentage_value / 100)) + Number($('#addBuyPrice').val());

        $('#addSellPrice').val(percentage);

    }    
});

//Percentage Change
$('.newPercentage').change(function(){

    if($('.percentage').prop("checked")){

        $('#addSellPrice').prop("readonly", true);
        
        var percentage_value = $('.newPercentage').val();
        var percentage = Number(($('#addBuyPrice').val() * percentage_value / 100)) + Number($('#addBuyPrice').val());

        $('#addSellPrice').val(percentage);

    }    
});

//Percentage Checkbox
$('.percentage').on('ifUnchecked', function(){
    $('#addSellPrice').prop("readonly", false);
    $('.newPercentage').prop("readonly", true);
});

$('.percentage').on('ifChecked', function(){
    $('#addSellPrice').prop("readonly", true);
    $('.newPercentage').prop("readonly", false);
});