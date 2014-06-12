<div class="addAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">Add New Users</div>
        <div class="panel-body">
            <form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
                <div class="form-group hide">
                    <label for="inputUser" class="col-lg-2 control-label">Text</label>
                    <div class="col-lg-5">
                        <input type="hidden" class="form-control" name="fields[user]" id="user" value="<?php print $_SESSION['user']['id']; ?>" placeholder="Text" required>
                    </div>
                </div>
                <div class="form-group">


                    <label for="inputUser" class="col-lg-2 control-label">Type of Post</label>
                    <div class="col-lg-5">
                        <select class="form-control" name="fields[post_type]" id="post_type" required> 
                            <option value="">Select Post Type</option>
                            <option value="text" <?php _cprint($post_type, 'text', "selected"); ?> >Text </option>
                            <option value="picture" <?php _cprint($post_type, 'picture', "selected"); ?> >Picture </option> 
                            <option value="video" <?php _cprint($post_type, "video", "selected"); ?>>Video </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Text</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[text]" id="text" value="<?php print $text; ?>" placeholder="Text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Select File</label>
                    <div class="col-lg-5">
                        <input type="file"  name="image" id="image" <?php if (empty($image_)): print "required"; endif; ?>>
                        <input type="hidden" name="fields[image_name]" id="image_name" value="<?php print $image_; ?>">
                        <?php if (!empty($image_)):?><div><img src="<?php print _MEDIA_URL . "img/" . $image_; ?>" width="100"  /></div><?php print $image_; endif;?>
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Media</label>
                    <div class="col-lg-5">
                        <input type="text" type="text" class="form-control" placeholder="Media" id="media" value="<?php print $media ?>" name="fields[media]" required />
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Location Latitude</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" placeholder="Location Latitude" id="latitude"  name="fields[latitude]" value="<?php print $latitude ?>" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Location Longitude</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[longitude]" id="longitude" value="<?php print $longitude; ?>" placeholder="Location Longitude" required>
                    </div>
                </div>


                <div class="form-group"> 
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="fields[users_id]" id="users_id" value="<?php print $id_val; ?>">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>