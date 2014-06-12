<div class="addAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">Add New Users</div>
        <div class="panel-body">
            <form method="post" action="" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Service Provider</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[name]" id="name" value="<?php print $name; ?>" placeholder="First Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Service Provider Category</label>
                    <div class="col-lg-5">
                        <select class="form-control" name="fields[service_category]" id="service_category" required> 
                            <option value="">Select Category</option>
                            <?php $service_category= q("select * from service_provider_category");
                            foreach ($service_category as $each_category):
                                ?> <option value="<?php print $each_category['id'] ?>" <?php _cprint($service_provider_category_id,  $each_category['id'], "selected"); ?> ><?php print $each_category['name'] ?></option>
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
                        <input type="hidden" name="fields[service_id]" id="service_id" value="<?php print $id_val; ?>">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>