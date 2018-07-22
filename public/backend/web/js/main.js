$(document).ready(function () {
    $('#delete').on('click', function () {
        let answer = confirm("Bạn có chắc muốn xóa sản phẩm này không");
        if(!answer){
            return false;
        }
    });
});