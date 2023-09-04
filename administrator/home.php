
<h3><center>Welcome to Cashier Queuing System</center></h3>
<hr>
<div class="col-12">
    <div class="col-md-12">
        
    <form action="" id="upload-form">
            <input type="hidden" name="video" value="<?php echo $video; ?>">
            <div class="row justify-content-center my-2">
                <div class="form-group col-md-4">
                    <label for="vid" class="control-label">Update Video</label>
                    <input type="file" name="vid" id="vid" class="form-control" accept="video/*" required>
                </div>
            </div>
            <div class="row justify-content-center my-2">
                <center>
                    <button class="btn btn-primary" type="submit">Update</button>
                </center>
            </div>
        </form>
    </div>
</div>
<div class="col-12">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Video Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="video-list">
                <!-- Video list will be populated here -->
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function(){
    $('#upload-form').submit(function(e){
        e.preventDefault();
        $('.pop_msg').remove()
        var _this = $(this)
        var _el = $('<div>')
        _el.addClass('pop_msg')
        _this.find('button').attr('disabled',true)
        _this.find('button[type="submit"]').text('Uploading video(s)...')

        $.ajax({
            url: './../Actions.php?a=update_video', // Adjust the URL as needed
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err)
                _el.addClass('alert alert-danger')
                _el.text("An error occurred. Please refresh the page.")
                _this.prepend(_el)
                _el.show('slow')
                _this.find('button').attr('disabled',false)
                _this.find('button[type="submit"]').text('Upload Video')
            },
            success: function(resp){
                if(resp.status == 'success'){
                    _el.addClass('alert alert-success')
                    location.reload()
                    // Clear the input field after successful upload
                    _this.get(0).reset();
                    // Update the video list
                    updateVideoList();
                } else {
                    _el.addClass('alert alert-danger')
                }
                _el.text(resp.msg)

                _el.hide()
                _this.prepend(_el)
                _el.show('slow')
                _this.find('button').attr('disabled',false)
                _this.find('button[type="submit"]').text('Upload Video')
            }
        });
    });

    // Function to update the video list
    function updateVideoList() {
        $.ajax({
            url: '../administrator/get_videos.php', // Replace with the appropriate URL
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var videoList = $('#video-list');
                videoList.empty();
                $.each(data, function(index, video) {
                    var row = $('<tr>');
                    row.append('<td>' + video.name + '</td>');
                    row.append('<td><button class="btn btn-danger delete-video" data-id="' + video.id + '">Delete</button></td>');
                    videoList.append(row);
                });
            }
        });
    }

    // Initial update of video list on page load
    updateVideoList();

    // Event handler for deleting videos
    $('#video-list').on('click', '.delete-video', function() {
        var videoId = $(this).data('id');
        $.ajax({
            url: '../administrator/delete_video.php?id=' + videoId, // Replace with the appropriate URL
            method: 'DELETE',
            dataType: 'json',
            success: function(resp) {
                if (resp.status === 'success') {
                    updateVideoList();
                } else {
                    console.error('Video deletion failed: ' + resp.msg);
                }
            }
        });
    });
});
</script>

