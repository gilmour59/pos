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

//When Category is changed in Add modal
$('#addCategory').change(function(){

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