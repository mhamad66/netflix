$(document.body).on('change', '#upload', function () {
    // hide box (click to upload)
    $('#movie_upload').css('display', 'none');
    // show properties movie
    $('#movie_properties').css('display', 'block');
    var url = $(this).data('url');
    // select first input file
    var movie = this.files[0];
    // search in stackoverflow (remove file extension from file name jquery)
    //ex: movie_name = bla.mp4 ---- remove mp4 from name  - in the next line
    var movie_name = movie.name.split('.').slice(0, -1).join('.');
    $('#input_name').val(movie_name);
    // get movie_id from data-movie-id
    var movieID = $(this).data('movie-id');
    /* 
     add data to database by ajax
    synatx : formData.append(name, value);
    formData.append(name, value, filename);
    */
    var formData = new FormData();
    formData.append('movie_id', movieID);
    formData.append('name', movie_name);
    formData.append('movie', movie);

    $.ajax({
        // type: "method",
        url: url,
        data: formData,
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        // dataType: "dataType",
        success: function (movieBeforeProcessing) {
            var interval = setInterval(function () {
                // Every time 3000 seconds
                $.ajax({
                    url: `/dashboard/movies/${movieBeforeProcessing.id}`,
                    method: 'GET',
                    success: function (movieWhileProcessing) {
                        $('#upload_state').html('processing');
                        $('#movie_upload_progress').css('width', movieWhileProcessing.percent + "%");
                        $('#movie_upload_progress').html(movieWhileProcessing.percent);

                        if(movieWhileProcessing.percent==100){
                            clearInterval(interval);
                            $('#upload_state').html('Done Processing');
                            $('#movie_upload_progress').parent().css('display','none');
                            $('#btn_submit_publish').css('display','block');
                            
                            
                        }
                    },
                });


                //  
            }, 3000);
        },
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = Math.round(evt.loaded / evt.total * 100) + "%";
                    //Do something with upload progress here
                    $('#movie_upload_progress').css('width', percentComplete).html(percentComplete)
                }
            }, false);

            return xhr;
        },

    });

});
