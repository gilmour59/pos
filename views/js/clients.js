//Edit Client
$(document).on('click', '.btn-edit-client', function(){

    var clientId = $(this).attr('data-client-id');
    
    var data = new FormData();
    data.append("clientId", clientId);

    $.ajax({

        url: "ajax/clients.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(request){
            $('#editName').val(request["name"]);
            $('#editDocumentId').val(request["document_id"]);
            $('#editEmail').val(request["email"]);
            $('#editPhone').val(request["phone"]);
            $('#editAddress').val(request["address"]);
            $('#editBirthdate').val(request["birthdate"]);            

            $('#clientId').val(request["id"]);            
        }
    });
});