<div class="addAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">Add New Users</div>
        <div class="panel-body">
            <form method="post" action="" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[name]" id="name" value="<?php print $name; ?>" placeholder="First Name" required>
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