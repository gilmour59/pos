$('#addPicture').change(function(){

    var image = this.files[0];

    //Restrict to only jpeg, jpg, and png
    if(image['type'] != 'image/jpeg' &&
        image['type'] != 'image/png' &&
        image['type'] != 'image/jpg'){

            $('#addPicture').val("");

            Swal.fire({
                icon: 'error',
                title: 'File type must be jpeg or png!',
                text: 'Wrong file type!',
            });
        }else if(image['size'] > 2000000){
            //Size limit
            $('#addPicture').val("");

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

                $('#imgPreview').attr('src', imageRoute);
            });
        }
});