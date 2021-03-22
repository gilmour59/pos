//Load Dynamic Datatable (test)
/* $.ajax({

    url: "ajax/datatable-products.ajax.php",
    success: function(response){
        console.log("response", response);
    }
}); */

//Capture the User Role
var user_role = $('#products-user-role').val();

//Load Dynamic Datatable
$('#products_table').DataTable({
    "ajax" : "ajax/datatable-products.ajax.php?user-role="+user_role,
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

    //This is for the checked percentage
    $('#editSellPrice').prop("readonly", true);

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
            
            //get Category names
            var category_data = new FormData();
            category_data.append("categoryId", request["category_id"]);

            $.ajax({

                url: "ajax/categories.ajax.php",
                method: "POST",
                data: category_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function($request){
                    $("#editCategoryProduct").val($request["id"]);
                    $("#editCategoryProduct").html($request["category"]);
                }
            });

            $('#productId').val(request["id"]);
            $('#editCode').val(request["code"]);
            $('#editDescription').val(request["description"]);
            $('#editStock').val(request["stock"]);
            $('#editBuyPrice').val(request["buy_price"]);
            $('#editSellPrice').val(request["sell_price"]);

            $('#currentImage').val(request["image"]);

            if(request["image"] != ""){
                $('#imgPreviewEdit').attr('src', request["image"]);
            }else{
                $('#imgPreviewEdit').attr('src', '/views/img/users/default/anonymous.png');
            }
        }
    });
});

//Adding Buy Price
$('#addBuyPrice').change(function(){

    if($('.percentage').prop("checked")){

        $('#addSellPrice').prop("readonly", true);
        
        var percentage_value = $('.newPercentage').val();
        var percentage = Number(($('#addBuyPrice').val() * percentage_value / 100)) + Number($('#addBuyPrice').val());

        $('#addSellPrice').val(percentage);

    }    
});

//Editing Buy Price
$('#editBuyPrice').change(function(){

    if($('.percentage').prop("checked")){

        $('#editSellPrice').prop("readonly", true);
        
        var percentage_value = $('.newPercentage').val();
        var percentage = Number(($('#editBuyPrice').val() * percentage_value / 100)) + Number($('#editBuyPrice').val());

        $('#editSellPrice').val(percentage);

    }    
});

//Percentage Change
$('.newPercentage').change(function(){

    if($('.percentage').prop("checked")){

        $('#addSellPrice').prop("readonly", true);
        $('#editSellPrice').prop("readonly", true);
        
        var percentage_value = $(this).val();
        //Add
        var percentage_add = Number(($('#addBuyPrice').val() * percentage_value / 100)) + Number($('#addBuyPrice').val());
        //Edit
        var percentage_edit = Number(($('#editBuyPrice').val() * percentage_value / 100)) + Number($('#editBuyPrice').val());

        $('#addSellPrice').val(percentage_add);
        $('#editSellPrice').val(percentage_edit);

    }    
});

//Percentage Checkbox
$('.percentage').on('ifUnchecked', function(){
    $('#addSellPrice').prop("readonly", false);
    $('#editSellPrice').prop("readonly", false);
    $('.newPercentage').prop("readonly", true);
});

$('.percentage').on('ifChecked', function(){
    $('#addSellPrice').prop("readonly", true);
    $('#editSellPrice').prop("readonly", true);
    $('.newPercentage').prop("readonly", false);
});

//Picture Validation
$('.picture-validate-products').change(function(){

    var image = this.files[0];

    //Restrict to only jpeg, jpg, and png
    if(image['type'] != 'image/jpeg' &&
        image['type'] != 'image/png' &&
        image['type'] != 'image/jpg'){

            $('#addImage').val("");
            $('#editImage').val("");

            Swal.fire({
                icon: 'error',
                title: 'File type must be jpeg or png!',
                text: 'Wrong file type!',
            });
        }else if(image['size'] > 2000000){
            //Size limit
            $('#addImage').val("");
            $('#editImage').val("");

            Swal.fire({
                icon: 'error',
                title: 'Image must be below 2MB!',
                text: 'Size error!',
            });
        }else{
            //Image Preview
            var dataImage = new FileReader;
            dataImage.readAsDataURL(image);

            $(dataImage).on("load", function(event){

                var imageRoute = event.target.result;

                $('#imgPreviewAdd').attr('src', imageRoute);
                $('#imgPreviewEdit').attr('src', imageRoute);
            });
        }
});

//Delete User
$(document).on('click', '.btn-delete-product', function(){

    var product_id = $(this).attr('data-product-id');
    var code = $(this).attr('data-product-code');
    var image = $(this).attr('data-product-image');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((response) => {
        if (response.isConfirmed){
            window.location = "index.php?route=products&delete-product-id="+ product_id +"&product-code="+ code +"&product-image="+ image;
        }
    });
});