//Load Dynamic Datatable
$.ajax({

    url: "ajax/datatable-products.ajax.php",
    success: function(response){
        console.log("response", response);
    }
});

$('#products_table').DataTable({
    "ajax" : "ajax/datatable-products.ajax.php"
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