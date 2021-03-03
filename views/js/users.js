$('.picture-validate').change(function(){

    var image = this.files[0];

    //Restrict to only jpeg, jpg, and png
    if(image['type'] != 'image/jpeg' &&
        image['type'] != 'image/png' &&
        image['type'] != 'image/jpg'){

            $('#addPicture').val("");
            $('#editPicture').val("");

            Swal.fire({
                icon: 'error',
                title: 'File type must be jpeg or png!',
                text: 'Wrong file type!',
            });
        }else if(image['size'] > 2000000){
            //Size limit
            $('#addPicture').val("");
            $('#editPicture').val("");

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

//Edit User
$(document).on('click', '.btn-edit-user', function(){

    var userId = $(this).attr('data-user-id');
    
    var data = new FormData();
    data.append("userId", userId);

    $.ajax({

        url: "ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(request){
            $('#editName').val(request["name"]);
            $('#editUsername').val(request["username"]);            
            $('#editRole').val(request["role"]);
            
            $('#currentPassword').val(request["password"]);
            $('#currentPicture').val(request["picture"]);

            $('#userId').val(request["id"]);

            if(request["picture"] != ""){
                $('#imgPreviewEdit').attr('src', request["picture"]);
            }else{
                $('#imgPreviewEdit').attr('src', '/views/img/users/default/anonymous.png');
            }
        }
    });
});

//User Activation
$(document).on('click', '.btn-activate', function(){
    
    var user_active_id = $(this).attr("data-user-id");
    var user_active_status = $(this).attr("data-user-status");
    
    var data = new FormData();
    data.append("user_active_id", user_active_id);
    data.append("user_active_status", user_active_status);

    $.ajax({

        url: "ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,        
        success: function(request){
        }
    });

    if(user_active_status == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Deactivated');
        $(this).attr('data-user-status', 1);
    }else{
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activated');
        $(this).attr('data-user-status', 0);
    }
});

//Check if username is taken
$('#addUsername').change(function(){

    $(".alert").remove();

    var username = $(this).val();

    var data = new FormData();
    data.append('validate_username', username);

    $.ajax({

        url: "ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,   
        dataType: "json",     
        success: function(request){
            
            if(request){
                $("#addUsername").parent().after('<div class="alert alert-warning">This username already exists!</div>');
                $("#addUsername").val("");
            }
        }
    })
});

//Delete User
$(document).on('click', '.btn-delete-user', function(){

    var user_id = $(this).attr('data-user-id');
    var picture = $(this).attr('data-user-picture');
    var username = $(this).attr('data-user-username');

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
            window.location = "index.php?route=users&delete-user-id="+ user_id +"&user-picture="+ picture +"&user-username="+ username;
        }
    });
});