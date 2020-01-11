console.log(`----------------------------`);
console.log(`-- MAIN JAVASCRIPT ENGINE --`);
console.log(`----------------------------`);
console.log(`built on democi framework`);
console.log(`https://github.com/ghiyastfarisi/democi`);
$(document).ready(function() {
    $('body .confirm-delete-data').on('click', function(){
        var ini = $(this);
        var deleteURL = ini.attr('data-delete-url');
        var deleteID = ini.attr('data-delete-id');
        bootbox.confirm("Are you sure delete this data?", function(cb){
            if (cb) {
                window.location.replace(BASE_URL+deleteURL+deleteID);
            }
        });
    });
});
