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

                            '<input type="text" class="form-control addProductDescription" data-product-id="' + product_id + '" name="addProductDescription" value="' + description + '" required readonly>' +
                        '</div>' +
                    '</div>' +

                    '<div class="col-xs-3 parentProductQuantity">' +
                        '<input type="number" class="form-control addProductQuantity" name="addProductQuantity" min="1" value="1" data-product-stock="' + stock + '" data-product-new-stock="' + Number(stock-1) + '" required>' +
                    '</div>' +

                    '<div class="col-xs-3 parentProductPrice" style="padding-left:0px;">' +
                        '<div class="input-group">' +
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                            '<input type="text" class="form-control addProductPrice" name="addProductPrice" data-product-price="' + price + '" value="' + price + '" readonly required>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );

            //Summary of Total Prices
            summaryTotalPrices();

            //Add Tax
            addTax();

            //Generating JSON product list
            listProducts();

            //Format the Product Price
            $('.addProductPrice').number(true, 2);

            //Generate Cash Change
            generateCashChange();
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

    //Generating JSON product list
    listProducts();

    //Generate Cash Change
    generateCashChange();
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

        /* //Summary of Total Prices
        summaryTotalPrices();

        //Add Tax
        addTax();

        //Generating JSON product list
        listProducts();

        //Generate Cash Change
        generateCashChange(); */

        Swal.fire({
            icon: 'error',
            title: 'Only ' + $(this).attr('data-product-stock') + ' Stock/s Available!',
            text: 'Something went wrong!',
        });
    }

    //Changing the new stock value
    var new_stock = Number($(this).attr('data-product-stock')) - Number($(this).val());
    $(this).attr('data-product-new-stock', new_stock);

    //Summary of Total Prices
    summaryTotalPrices();
    
    //Add Tax
    addTax();

    //Generating JSON product list
    listProducts();

    //Generate Cash Change
    generateCashChange();
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

    //Generating JSON product list
    listProducts();

    //Generate Cash Change
    generateCashChange();
});

//Format Total Price
$('#addSaleTotal').number(true, 2);

//Selection of Payment Method
$(document).on('change', '#addPaymentMethod', function(){
    
    var method = $(this).val();

    if(method == "cash"){

        //changing the col size
        $(this).parent().parent().removeClass('col-xs-6');
        $(this).parent().parent().addClass('col-xs-4');
        $(this).parent().parent().parent().children('.methodPaymentBoxes').html(
            '<div class="col-xs-4">' +
                '<div class="input-group">' +
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                    '<input type="text" class="form-control addCashValue" id="addCashValue" placeholder="0000.00" required>' +
                '</div>' +
            '</div>' +
            '<div class="col-xs-4 cashChange" style="padding-left: 0px;">' +
                '<div class="input-group">' +
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                    '<input type="text" class="form-control addCashChange" name="addCashChange" id="addCashChange" placeholder="0000.00" readonly required>' +
                '</div>' +
            '</div>'
        );

        //on changing to cash
        listPaymentMethods();

        //Format Cash
        $('#addCashValue').number(true, 2);
        $('#addCashChange').number(true, 2);
    }else{

        //changing the col size
        $(this).parent().parent().removeClass('col-xs-4');
        $(this).parent().parent().addClass('col-xs-6');
        $(this).parent().parent().parent().children('.methodPaymentBoxes').html(
            '<div class="col-xs-6" style="padding-left: 0px;">' +
                '<div class="input-group">' +
                    '<input type="text" class="form-control" id="newCodeTransaction" name="newCodeTransaction" placeholder="Code Transaction" required>' +
                    '<span class="input-group-addon"><i class="fa fa-lock"></i></span>' +
                '</div>' +
            '</div>'
        );
    }
});

//Other than Cash Transaction
$("#sale-add-form").on("change", "input#newCodeTransaction", function(){

    listPaymentMethods();
});

//Format Cash
$('#addCashValue').number(true, 2);
$('#addCashChange').number(true, 2);

//Change in Cash
$("#sale-add-form").on("change", "input#addCashValue", function(){

    generateCashChange();
});

function generateCashChange(){
    
    var cash = $('#addCashValue').val();
    var change = Number(cash) - Number($('#addSaleTotal').val());

    var new_change = $('#addCashValue').parent().parent().parent().children('.cashChange').children().children('#addCashChange');
    
    new_change.val(change);
}

//Adding to database (json)
function listProducts(){

    var product_list = [];

    //Getting all the table columns
    var id;
    var description = $('.addProductDescription');
    var quantity = $('.addProductQuantity');
    var price = $('.addProductPrice');
    var total;

    for(var i = 0; i < description.length; i++){

        product_list.push({
            "id" : $(description[i]).attr('data-product-id'),
            "description" : $(description[i]).val(),
            "quantity" : $(quantity[i]).val(),
            "stock" : $(quantity[i]).attr('data-product-new-stock'),
            "net_price" : $(price[i]).attr('data-product-price'),
            "total_price" : $(price[i]).val()
        });
    }

    console.log('product_list', product_list);

    //This is different in the vid
    $('#productList').val(JSON.stringify(product_list));
}

//List of Payment Methods
function listPaymentMethods(){

    var payment_method_list = "";

    if($('#addPaymentMethod').val() == "cash"){

        $('#paymentMethodList').val('cash');
    }else{
        
        $('#paymentMethodList').val($('#addPaymentMethod').val() + "-" + $('#newCodeTransaction').val());
    }
}

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
                        '<input type="number" class="form-control addProductQuantity" name="addProductQuantity" min="1" value="1" data-product-stock data-product-new-stock required>' +
                    '</div>' +

                    '<div class="col-xs-3 parentProductPrice" style="padding-left:0px;">' +
                        '<div class="input-group">' +
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                            '<input type="text" class="form-control addProductPrice" name="addProductPrice" data-product-price value readonly required>' +
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

            //Format the Product Price
            $('.addProductPrice').number(true, 2);

            //Generate Cash Change
            generateCashChange();
        }
    });
});

//Select Product (mobile)
$("#sale-add-form").on("change", "select.addProductDescription", function(){

    var product_name = $(this).val();
    var product_id = $(this);

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

            $(product_id).attr("data-product-id", response['id']);
            $(product_quantity).attr("data-product-stock", response['stock']);
            $(product_quantity).attr("data-product-new-stock", Number(response['stock'] - 1));
            $(product_price).val(response['sell_price']);
            $(product_price).attr("data-product-price", response['sell_price']);            

            //Summary of Total Prices
            summaryTotalPrices();

            //Add Tax
            addTax();

            //Generating JSON product list
            listProducts();

            //Generate Cash Change
            generateCashChange();
          }
    });
});