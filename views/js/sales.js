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

                            '<input type="text" class="form-control addProductDescription" name="addProductDescription" value="' + description + '" required readonly>' +
                        '</div>' +
                    '</div>' +

                    '<div class="col-xs-3 parentProductQuantity">' +
                        '<input type="number" class="form-control addProductQuantity" name="addProductQuantity" min="1" value="1" data-product-stock="' + stock + '" required>' +
                    '</div>' +

                    '<div class="col-xs-3 parentProductPrice" style="padding-left:0px;">' +
                        '<div class="input-group">' +
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                            '<input type="number" class="form-control addProductPrice" name="addProductPrice" data-product-price="' + price + '" min="1" value="' + price + '" readonly required>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );

            //Summary of Total Prices
            summaryTotalPrices();

            //Add Tax
            addTax();
        }
    });
});

//When using the table
/* $("#products-sales-table").on("draw.dt", function(){
   
    var list_remove_storage = [];

    if(localStorage.getItem("removeProduct") != null){

        //convert JSON to object
        var list_id_products = JSON.parse(localStorage.getItem("removeProduct"));        
        list_remove_storage = list_id_products;

        for(var i = 0; i < list_id_products.length; i++){            

            //Check if button exist and remove it from the localStorage
            if($("button.recoverProduct[data-product-id='"+ list_id_products[i]["product_id"] +"']").length){

                $("button.recoverProduct[data-product-id='"+ list_id_products[i]["product_id"] +"']").removeClass('btn-default');
                $("button.recoverProduct[data-product-id='"+ list_id_products[i]["product_id"] +"']").addClass('btn-primary addProduct');             

                //to remove from localStorage
                list_remove_storage = list_remove_storage.filter(product => product.product_id != list_id_products[i]["product_id"]);

                localStorage.setItem("removeProduct", JSON.stringify(list_remove_storage));
            }
        }            
    }
    console.log("list_remove_storage", list_remove_storage);
    console.log("list_id_product", list_id_products);
}); */

//to store
var id_remove_product = [];

localStorage.removeItem("removeProduct");

//Delete product from form and recovery button
$("#sale-add-form").on("click", "button.removeProduct", function(){

    $(this).parent().parent().parent().parent().remove();

    var product_id = $(this).attr("data-product-id");    

    //localstorage for the sales product activation bug when going to next page
    if(localStorage.getItem("removeProduct") != null){

        //Find if product is in localstorage (to avoid duplication)
        var dupe = false;
        var list_id_products = JSON.parse(localStorage.getItem("removeProduct"));

        for(var i = 0; i < list_id_products.length; i++) {
            if(list_id_products[i]["product_id"] == product_id) {
                
                dupe = true;
                break;
            }
        }

        //remove the dupe verification if the table change has been fixed
        if(dupe === false){

            //if Button exist then there is no need to save to localStorage
            if($("button.recoverProduct[data-product-id='"+ product_id +"']").length){

                //changing classes of buttons
                $("button.recoverProduct[data-product-id='"+ product_id +"']").removeClass('btn-default');
                $("button.recoverProduct[data-product-id='"+ product_id +"']").addClass('btn-primary addProduct');
            }else{

                //This triggers when you are in another page and the button is not seen
                id_remove_product.concat(localStorage.getItem("removeProduct"));

                //getting the id for the local storage
                id_remove_product.push({"product_id" : product_id});
                localStorage.setItem("removeProduct", JSON.stringify(id_remove_product));
            }            
        }  

    }else{
        
        //if Button exist then there is no need to save to localStorage
        if($("button.recoverProduct[data-product-id='"+ product_id +"']").length){

            //changing classes of buttons
            $("button.recoverProduct[data-product-id='"+ product_id +"']").removeClass('btn-default');
            $("button.recoverProduct[data-product-id='"+ product_id +"']").addClass('btn-primary addProduct');
        }else{

            //This triggers when you are in another page and the button is not seen
            id_remove_product = [];

            //getting the id for the local storage
            id_remove_product.push({"product_id" : product_id});
            localStorage.setItem("removeProduct", JSON.stringify(id_remove_product));   
        }        
    }    
    
    //Summary of Total Prices
    summaryTotalPrices();

    //Add Tax
    addTax();
});

//when using tables
$("#products-sales-table").on("draw.dt", function(){
   
    var list_remove_storage = [];

    if(localStorage.getItem("removeProduct") != null){

        //id_remove_product array reset (global var)
        id_remove_product = JSON.parse(localStorage.getItem("removeProduct"));  

        list_remove_storage = id_remove_product;

        for(var i = 0; i < id_remove_product.length; i++){            

            //Check if button exist and remove it from the localStorage
            if($("button.recoverProduct[data-product-id='"+ id_remove_product[i]["product_id"] +"']").length){

                $("button.recoverProduct[data-product-id='"+ id_remove_product[i]["product_id"] +"']").removeClass('btn-default');
                $("button.recoverProduct[data-product-id='"+ id_remove_product[i]["product_id"] +"']").addClass('btn-primary addProduct');             

                //to remove from localStorage
                list_remove_storage = list_remove_storage.filter(product => product.product_id != id_remove_product[i]["product_id"]);

                localStorage.setItem("removeProduct", JSON.stringify(list_remove_storage));
            }
        }            
    }
});

//modify the quantity
$("#sale-add-form").on("change", "input.addProductQuantity", function(){

    //Multiple to number of quantity
    var product_price = $(this).parent().parent().children('.parentProductPrice').children().children('.addProductPrice');
    var final_price = $(this).val() * product_price.attr('data-product-price');
    product_price.val(final_price);

    //Stock Validation
    if(Number($(this).val()) > Number($(this).attr('data-product-stock'))){

        $(this).val(1);
        
        //fixes the value bug
        product_price.val($(this).val() * product_price.attr('data-product-price'));

        //Summary of Total Prices
        summaryTotalPrices();

        //Add Tax
        addTax();

        Swal.fire({
            icon: 'error',
            title: 'Only ' + $(this).attr('data-product-stock') + ' Stock/s Available!',
            text: 'Something went wrong!',
        });
    }

    //Summary of Total Prices
    summaryTotalPrices();
    
    //Add Tax
    addTax();
});

//Sum of Product Prices
function summaryTotalPrices(){

    //get all the prices (this is an array)
    var product_prices = $(".addProductPrice");
    var price_array = []; 

    for(var i = 0; i < product_prices.length; i++){
        price_array.push(Number($(product_prices[i]).val()));
    }

    function sumArrayPrices(total, number){
        
        return total + number;
    }

    var sum_price = 0;

    //check if array is empty
    if(price_array.length == 0){
        sum_price = 0;
    }else{
        //Passing the array adding from left to right
        sum_price = price_array.reduce(sumArrayPrices);
    }
    
    $('#addSaleTotal').val(sum_price);
    $('#addSaleTotal').attr('data-sale-total', sum_price);
}

//Add Tax
function addTax(){

    var tax = $('#addSaleTax').val();
    var price_total = $('#addSaleTotal').val();

    var tax_price = Number(price_total * (tax / 100));

    var total_with_tax = Number(tax_price) + Number(price_total);

    $('#addSaleTotal').val(total_with_tax);
    $('#addPriceTax').val(tax_price);
    $('#addPriceNet').val(price_total);
}

$(document).on('change', '#addSaleTax', function(){
    
    //Summary of Total Prices
    summaryTotalPrices();

    //Add Tax
    addTax();
});



//-----------------------------------------------------------------------------------------------------------------------------------------
//MOBILE
//Adding products with button (mobile)

//to keep track of the added products
var product_number = 0;

$(document).on('click', '#btn-add-product-mobile', function(){
   
    product_number++;

    var data = new FormData();
	data.append("showProductsMobile", "ok");

	$.ajax({

		url: "ajax/products.ajax.php",
      	method: "POST",
      	data: data,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType: "json",
      	success: function(response){
            
            $(".newProduct").append(

                '<div class="row" style="padding:5px 15px">' + 

                    '<div class="col-xs-6" style="padding-right:0px;">' +
                        '<div class="input-group">' +

                            '<span class="input-group-addon">' +
                                '<button type="button" class="btn btn-danger btn-xs removeProduct" data-product-id>' +
                                '<i class="fa fa-times"></i>' +
                                '</button>' +
                            '</span>' +

                            '<select class="form-control addProductDescription" id="product'+ product_number +'" data-product-id name="addProductDescription" required>' +
                                '<option>Select Product</option>' +
                            '</select>' +
                        '</div>' +
                    '</div>' +

                    '<div class="col-xs-3 parentProductQuantity">' +
                        '<input type="number" class="form-control addProductQuantity" name="addProductQuantity" min="1" value="1" data-product-stock required>' +
                    '</div>' +

                    '<div class="col-xs-3 parentProductPrice" style="padding-left:0px;">' +
                        '<div class="input-group">' +
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                            '<input type="number" class="form-control addProductPrice" name="addProductPrice" min="1" data-product-price value readonly required>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );

            //Show products in select
            response.forEach(getAllProductsFunction);
            
            function getAllProductsFunction(item, index){

                if(item.stock != 0){
                    
                    $("#product" + product_number).append(

                        '<option data-product-id="'+ item.id +'" value="'+ item.description +'">'+ item.description +'</option>'
                    );
                }                                 
            }
            //Summary of Total Prices
            summaryTotalPrices();

            //Add Tax
            addTax();
        }
    });
});

//Select Product (mobile)
$("#sale-add-form").on("change", "select.addProductDescription", function(){

    var product_name = $(this).val();

    //to avoid duplication of all the values. This only isolates the new SELECT made
    var product_price = $(this).parent().parent().parent().children('.parentProductPrice').children().children('.addProductPrice');
    var product_quantity = $(this).parent().parent().parent().children('.parentProductQuantity').children('.addProductQuantity');

    var data = new FormData();
    data.append("productName", product_name);

    $.ajax({

        url: "ajax/products.ajax.php",
      	method: "POST",
      	data: data,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType: "json",
      	success: function(response){
            console.log(response);
            $(product_quantity).attr("data-product-stock", response['stock']);
            $(product_price).val(response['sell_price']);
            $(product_price).attr("data-product-price", response['sell_price']);

            //Summary of Total Prices
            summaryTotalPrices();

            //Add Tax
            addTax();
          }
    });
});