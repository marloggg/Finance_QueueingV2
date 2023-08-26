<h3><center>Welcome to Cashier Queuing System</center></h3>
<hr>
<div class="col-12">
    <div class="col-md-12">
        <?php 
            $vid = scandir('./../video');
            $video = $vid[2];
            if($video):
        ?>
            <center><video src="./../video/<?php echo $video ?>" autoplay muted controls id="vid_loop" class="bg-dark" loop style="height:50vh;width:75%"></video></center>
        <?php 
            endif; 
        ?>
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
    <?php 
    $imageFiles = scandir('./../images');
    $image = isset($imageFiles[2]) ? $imageFiles[2] : ""; // Check if index 2 exists before accessing
    if ($image):
?>
    <center><img src="./../images/<?php echo $image; ?>" alt="Uploaded Image" style="height: 15%; width: 25%;" class="bg-dark"></center>
<?php 
    endif; 
?>

        <form action="" id="upload-formimage">
            <input type="hidden" name="image" value="<?php echo $image; ?>">
            <div class="row justify-content-center my-2">
                <div class="form-group col-md-4">
                    <label for="img" class="control-label">Update Image</label>
                    <input type="file" name="img" id="img" class="form-control" accept="image/*" required>
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
<script>
    $(function(){
        $('#upload-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled',true)
            _this.find('button[type="submit"]').text('updating video...')
            $.ajax({
                url:'./../Actions.php?a=update_video',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred. Please refresh page")
                    _this.prepend(_el)
                    _el.show('slow')
                     _this.find('button').attr('disabled',false)
                     _this.find('button[type="submit"]').text('Update')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        location.reload()
                        if("<?php echo isset($department_id) ?>" != 1)
                        _this.get(0).reset();
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                     _this.find('button').attr('disabled',false)
                     _this.find('button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>
<script>
    $(function(){
        $('#upload-formimage').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled', true)
            _this.find('button[type="submit"]').text('Uploading image...')
            
            // Modify the URL to point to the updated image upload endpoint
            $.ajax({
                url: './../Actions.php?a=update_image', // Updated endpoint for images
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
                    _this.find('button').attr('disabled', false)
                    _this.find('button[type="submit"]').text('Upload Image')
                },
                success: function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        location.reload()
                        if("<?php echo isset($department_id) ?>" != 1)
                            _this.get(0).reset();
                    } else {
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled', false)
                    _this.find('button[type="submit"]').text('Upload Image')
                }
            })
        })
    })
</script>