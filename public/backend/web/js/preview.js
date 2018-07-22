function previewImage(target, identify) {
    //Image Preview
    if(window.File && window.FileList && window.FileReader) {
        $(target).on("change",function(e) {
            var imgThumb = document.getElementById(identify);
            if (document.contains(document.getElementById(identify))) {
                imgThumb.remove();
            }
            var files = e.target.files ,
                filesLength = files.length ;
            for (var i = 0; i < filesLength ; i++) {
                var f = files[i];
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<img></img>",{
                        class : identify,
                        id : identify,
                        src : e.target.result,
                        title : file.name
                    }).insertAfter(target);
                });
                fileReader.readAsDataURL(f);
            }
        });
    } else { alert("Your browser doesn't support to File API") }
}

function previewImages(target, identify) {
    //Image Preview
    if(window.File && window.FileList && window.FileReader) {
        $(target).on("change",function(e) {
            var imgThumb = document.getElementById(identify);
            if (document.contains(document.getElementById(identify))) {
                imgThumb.remove();
            }
            var files = e.target.files ,
                filesLength = files.length ;
            for (var i = 0; i < filesLength ; i++) {
                var f = files[i];
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<img></img>",{
                        class : identify,
                        id : identify ,
                        src : e.target.result,
                        title : file.name
                    }).insertAfter(target);
                });
                fileReader.readAsDataURL(f);
            }
        });
    } else { alert("Your browser doesn't support to File API") }


}