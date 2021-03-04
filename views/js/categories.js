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