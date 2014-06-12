<div class="addAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">Add New Neighborhood</div>
        <div class="panel-body">
            <form method="post" action="" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[name]" id="name" value="<?php print $name; ?>" placeholder="First Name" required>
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Location </label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" placeholder="Location " id="location"  name="fields[location]" value="<?php print $locations ?>" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">User</label>
                    <div class="col-lg-5">
                        <select class="form-control" name="fields[user]" id="user" required> 
                            <option value="">Select User</option>
                            <?php $user = q("select * from user");
                            foreach ($user as $each_user):
                                ?> <option value="<?php print $each_user['id'] ?>" <?php _cprint($user_,  $each_user['id'], "selected"); ?> ><?php print $each_user['first_name'] ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
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
                        <input type="hidden" name="fields[neighborhood_id]" id="neighborhood_id" value="<?php print $id_val; ?>">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>