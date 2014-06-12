<div class="addAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">Add New Profile</div>
        <div class="panel-body">
            <form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputProfile" class="col-lg-2 control-label">About</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[about]" id="about" value="<?php print $about; ?>" placeholder="About" >
                    </div>
                </div>

                <div class="form-group" >
                    <label for="inputProfile" class="col-lg-2 control-label">Address</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[address]" id="address" value="<?php print $address_val; ?>" placeholder="Address" required>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="inputProfile" class="col-lg-2 control-label">City</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[city]" id="city" value="<?php print $city_val; ?>" placeholder="City" required>
                    </div>
                </div>

                <div class="form-group " >
                    <label for="inputProfile" class="col-lg-2 control-label">State</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[state]" id="state" value="<?php print $state_val; ?>" placeholder="State" required>
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputProfile" class="col-lg-2 control-label">Zipcode</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[zip]" id="zipcode" value="<?php print $zipcode_val; ?>" placeholder="Zipcode" required>
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputProfile" class="col-lg-2 control-label">Location Latitude</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" placeholder="Location Latitude" id="latitude"  name="fields[latitude]" value="<?php print $location_latitude ?>" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputProfile" class="col-lg-2 control-label">Location Longitude</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[longitude]" id="longitude" value="<?php print $location_longitude; ?>" placeholder="Location Longitude" required>
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