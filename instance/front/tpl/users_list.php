<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Users</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($users)):
                ?>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>User Name</th>
                            <th>Profile Picture</th>
                            <th>Service Provider</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Phone no</th>
                            <th>Zipcode</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        <?php foreach ($users as $each_user): ?>
                            <tr>
                                <td><?php print $cr; ?></td>
                                <td><?php print $each_user['first_name']; ?></td>
                                <td><?php print $each_user['last_name']; ?></td>
                                <td><?php print $each_user['email']; ?></td>
                                <td><?php print $each_user['username']; ?></td>
                                <td>
                                    <?php
                                    $image_path = User::GetProfilePicture($each_user['email']);
                                    ?>
                                    <img src="<?php print $image_path; ?>" width="100"  />
                              </td>
                                <td><?php
                                 $service = qs("select * from user_has_service_provider where user_id = '{$each_user['id']}'");
                                    $service_provider = qs("select * from service_provider where id = '{$service['service_provider_id']}'");

                                    print $service_provider['name'];?></td>
                              
                                <td><?php print $each_user['address']; ?></td>
                                <td><?php print $each_user['city']; ?></td>
                                <td><?php print $each_user['state']; ?></td>

                                <td><?php print $each_user['phone_no']; ?></td>
                                <td><?php print $each_user['zipcode']; ?></td>

                                <td>
                                    <a href="<?php print _U ?>users/edit/<?php print $each_user['id']; ?>"><i class="glyphicon glyphicon-edit" title="Edit"></i></a>
                                    <a href="javascript:void(0);" onclick="return DeleteUser('users/delete/<?php print $each_user['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                </td>
                            </tr>
                            <?php $cr++; ?>    
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div>No User Available</div>
            <?php endif; ?>
        </div>
    </div>
</div>