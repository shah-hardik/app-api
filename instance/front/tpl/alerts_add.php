<div class="addAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">Add New Neighborhood</div>
        <div class="panel-body">
            <form method="post" action="" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Alert Type</label>
                    <div class="col-lg-5">
                        <select class="form-control" name="fields[type]" id="type" required> 
                            <option value="">Select Post Type</option>
                            <option value="Request" <?php _cprint($type, 'Request', "selected"); ?> >Request</option>
                            <option value="Like" <?php _cprint($type, 'Like', "selected"); ?> >Like </option> 
                            <option value="Comment" <?php _cprint($type, "Comment", "selected"); ?>>Comment </option>
                        </select>
                    </div>
                </div>
                 <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Alert </label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" placeholder="Alert " id="alert"  name="fields[alert]" value="<?php print $alert ?>" required />
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