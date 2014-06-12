<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Neighborhood</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($neighborhood)):
                ?>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>User</th>
                            <th>Location</th>
                            <th>Block User(Y/N)</th>
                            <th>Location Latitude</th>
                            <th>Location Longitude</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        <?php foreach ($neighborhood as $each_data): ?>
                            <tr>
                                <td><?php print $cr; ?></td>
                                <td><?php print $each_data['name']; ?></td>

                                <td><?php
                                    $neighborhood_has_user = qs("SELECT * FROM neighborhood_has_user where neighborhood_id='{$each_data['id']}'");
                                    $user = qs("SELECT * FROM user where id='{$neighborhood_has_user['user_id']}'");
                                    print $user['first_name'];
                                    ?></td>
                                <td><?php print $each_data['location']; ?></td>
                                <td><?php
                                    $neighborhood_blocked_user = qs("SELECT * FROM  neighborhood_blocked_user where neighborhood_id='{$each_data['id']}'");
                                    $user = qs("SELECT * FROM user where id='{$neighborhood_blocked_user['user_id']}'");

                                    if (empty($user)) {
                                        print 'No';
                                    } else {
                                        print 'YES';
                                    }
                                    ?></td>

                                <td><?php print $each_data['location_latitude']; ?></td>
                                <td><?php print $each_data['location_longitude']; ?></td>
                                <td>
                                    <a href="<?php print _U ?>neighborhood/edit/<?php print $each_data['id']; ?>"><i class="glyphicon glyphicon-edit" title="Edit"></i></a>
                                    <a href="javascript:void(0);" on onclick="return DeleteNeighborhood('neighborhood/delete/<?php print $each_data['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                </td>
                            </tr>
                            <?php $cr++; ?>    
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div>No Neighborhood Available</div>
            <?php endif; ?>
        </div>
    </div>
</div>