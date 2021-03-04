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