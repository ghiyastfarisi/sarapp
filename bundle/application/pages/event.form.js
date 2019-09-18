var reader = new FileReader();
reader.onload = function (e) {
    var image = '<img style="max-width:80%;"  src="'+e.target.result+'" class="img-thumbnail" />';
    $('#image-container').html(image);
}
function readURL(input) {
    if (input.files && input.files[0]) {
        fileSize = input.files[0].size;
        if (fileSize > 1024 * 1024 * 2) {
            alert('Maximum image size 2MB');
            $("#image-upload").val('');
            return false;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function(){
    $("#image-upload").change(function(){
        readURL(this);
    })
});