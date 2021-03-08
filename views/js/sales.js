//Load Dynamic Datatable
$('#products-sales-table').DataTable({
    "ajax" : "ajax/datatable-sales.ajax.php",
    "deferRender" : true,
    "retrieve" : true,
    "processing" : true
});

//Adding products from tables to form
$("#products-sales-table tbody").on("click", "button.addProduct", function(){
    
    var product_id = $(this).attr("data-product-id");
    
    //to replace to recover button
    $(this).removeClass("btn-primary addProduct");
    $(this).addClass("btn-default");

    //To get the details of the product to the other form
    var data = new FormData();
    data.append("productId", product_id);

    $.ajax({
        
        url: "ajax/products.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response){
            
            var description = response["description"];
            var stock = response["stock"];
            var price = response["sell_price"];

            //restricts when stock is 0
            if(stock == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'No Stock Available!',
                    text: 'Something went wrong!',
                });

                $("button[data-product-id='" + product_id + "']").addClass('btn-primary addProduct');

                return;
            }

            $(".newProduct").append(

                '<div class="row" style="padding:5px 15px">' + 

                    '<div class="col-xs-6" style="padding-right:0px;">' +
                        '<div class="input-group">' +

                            '<span class="input-group-addon">' +
                                '<button type="button" class="btn btn-danger btn-xs removeProduct" data-product-id="' + product_id + '">' +
                                '<i class="fa fa-times"></i>' +
                                '</button>' +
                            '</span>' +

                            '<input type="text" class="form-control" id="addProduct" name="addProduct" value="' + description + '" required readonly>' +
                        '</div>' +
                    '</div>' +

                    '<div class="col-xs-3">' +
                        '<input type="number" class="form-control" id="addProductQuantity" name="addProductQuantity" min="1" value="1" data-sale-stock="' + stock + '" required>' +
                    '</div>' +

                    '<div class="col-xs-3" style="padding-left:0px;">' +
                        '<div class="input-group">' +
                        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                        '<input type="number" class="form-control" id="addProductPrice" name="addProductPrice" min="1" value="' + price + '" readonly required>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );
        }
    });
});

//When using the table
$("#products-sales-table").on("draw.dt", function(){
    
    if(localStorage.getItem("removeProduct") != null){

        //convert JSON to object
        var list_id_products = JSON.parse(localStorage.getItem("removeProduct"));
        
        for(var i = 0; i < list_id_products.length; i++){
            $("button.recoverProduct[data-product-id='"+ list_id_products[i]["product_id"] +"']").removeClass('btn-default');
            $("button.recoverProduct[data-product-id='"+ list_id_products[i]["product_id"] +"']").addClass('btn-primary addProduct');
        }
    }
});

//to store
var id_remove_product = [];

localStorage.removeItem("removeProduct");

//Delete product from form and recovery button
$("#sale-add-form").on("click", "button.removeProduct", function(){

    $(this).parent().parent().parent().parent().remove();

    var product_id = $(this).attr("data-product-id");

    //localstorage for the sales product activation bug when going to next page
    if(localStorage.getItem("removeProduct") == null){
        
        id_remove_product = [];
    }else{
        
        id_remove_product.concat(localStorage.getItem("removeProduct"));
    }

    //getting the id for the local storage
    id_remove_product.push({"product_id" : product_id});

    localStorage.setItem("removeProduct", JSON.stringify(id_remove_product));

    $("button.recoverProduct[data-product-id='"+ product_id +"']").removeClass('btn-default');
    $("button.recoverProduct[data-product-id='"+ product_id +"']").addClass('btn-primary addProduct');
});