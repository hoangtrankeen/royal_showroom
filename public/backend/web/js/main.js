$(document).ready(function () {
    $('#delete').on('click', function () {
        let answer = confirm("Bạn có chắc muốn xóa item này không");
        if(!answer){
            return false;
        }
    });


});


