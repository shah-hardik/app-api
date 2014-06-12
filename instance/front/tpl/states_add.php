<div class="addAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">Add New Users</div>
        <div class="panel-body">
            <form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
                <div class="form-group ">
                    <label for="inputUser" class="col-lg-2 control-label">Posts Count</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[posts_count]" id="posts_count" value="<?php print $posts_count ?>" placeholder="Posts Count" required>
                    </div>
                </div>
           
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Neighborhoods Count</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[neighborhoods_count]" id="neighborhoods_count" value="<?php print $neighborhoods_count; ?>" placeholder="Neighborhoods Count" required>
                    </div>
                </div>
                
                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Neighbors Count</label>
                    <div class="col-lg-5">
                        <input type="text" type="text" class="form-control" placeholder="Neighbors Count" id="neighbors_count" value="<?php print $neighbors_count ?>" name="fields[neighbors_count]" required />
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Lists count</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" placeholder="Lists count" id="lists_count"  name="fields[lists_count]" value="<?php print $lists_count ?>" required />
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