//Edit Category
$(document).on('click', '.btn-edit-category', function(){

    var categoryId = $(this).attr('data-category-id');
    
    var data = new FormData();
    data.append("categoryId", categoryId);

    $.ajax({

        url: "ajax/categories.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(request){
            $('#editCategory').val(request["category"]);

            $('#categoryId').val(request["id"]);            
        }
    });
});

//Delete Category
$(document).on('click', '.btn-delete-category', function(){

    var category_id = $(this).attr('data-category-id');

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
            window.location = "index.php?route=categories&delete-category-id="+ category_id;
        }
    });
});

//Check if category is taken
$('#addCategory').change(function(){

    $(".alert-warning").remove();

    var category = $(this).val();

    var data = new FormData();
    data.append('validate_category', category);

    $.ajax({

        url: "ajax/categories.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,   
        dataType: "json",     
        success: function(request){
            
            if(request){
                $(".alert-warning").remove();
                $("#addCategory").parent().after('<div class="alert alert-warning">This category already exists!</div>');
                $("#addCategory").val("");
            }
        }
    })
});

//Check if category is taken
$('#editCategory').change(function(){

    $(".alert-warning").remove();

    var category = $(this).val();

    var data = new FormData();
    data.append('validate_category', category);

    $.ajax({

        url: "ajax/categories.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,   
        dataType: "json",     
        success: function(request){
            
            if(request){
                $(".alert-warning").remove();
                $("#editCategory").parent().after('<div class="alert alert-warning">This category already exists!</div>');
            }
        }
    })
});

//Check if category is taken when pressing enter
$("#category-add-submit").on('click', function(event){
    event.preventDefault();

    $(".alert-warning").remove();

    var category = $('#addCategory').val();

    var data = new FormData();
    data.append('validate_category', category);

    $.ajax({

        url: "ajax/categories.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,   
        dataType: "json",     
        success: function(request){            
            if(request){     
                $(".alert-warning").remove();      
                $("#addCategory").parent().after('<div class="alert alert-warning">This category already exists!</div>');                        
                return false;
            }else{
                if($("#addCategory").val() == ""){
                    $(".alert-warning").remove();
                    $("#addCategory").parent().after('<div class="alert alert-warning">This category already exists or Empty!</div>');
                    $("#addCategory").val("");
                }else{
                    $('#category-add-form').submit();
                }                
            }
        }
    })    
});

//Check if category is taken when pressing enter
$("#category-edit-submit").on('click', function(event){
    event.preventDefault();

    $(".alert-warning").remove();

    var category = $('#editCategory').val();

    var data = new FormData();
    data.append('validate_category', category);

    $.ajax({

        url: "ajax/categories.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,   
        dataType: "json",     
        success: function(request){            
            if(request){      
                $(".alert-warning").remove();      
                $("#editCategory").parent().after('<div class="alert alert-warning">This category already exists!</div>');                    
                return false;
            }else{
                if($("#editCategory").val() == ""){
                    $(".alert-warning").remove();
                    $("#editCategory").parent().after('<div class="alert alert-warning">This category already exists!</div>');
                    return false;                    
                }else{
                    $('#category-edit-form').submit();
                }                
            }
        }
    })    
});