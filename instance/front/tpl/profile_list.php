<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Profile</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($profile)):
                ?>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>About</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zipcode</th>
                            <th>Location Latitude</th>
                            <th>Location Longitude</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        <?php foreach ($profile as $each_data): ?>
                            <tr>
                                <td><?php print $cr; ?></td>
                                <td><?php print $each_data['about']; ?></td>
                                <td><?php print $each_data['address']; ?></td>
                                <td><?php print $each_data['city']; ?></td>
                                <td><?php print $each_data['state']; ?></td>
                                <td><?php print $each_user['zip']; ?></td>
                                <td><?php print $each_data['location_latitude']; ?></td>
                                <td><?php print $each_data['location_longitude']; ?></td>

                                <td>
                                    <a href="<?php print _U ?>profile/edit/<?php print $each_user['id']; ?>"><i class="glyphicon glyphicon-edit" title="Edit"></i></a>
                                    <a href="javascript:void(0);" onclick="return DeleteProfile('profile/delete/<?php print $each_user['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                </td>
                            </tr>
                            <?php $cr++; ?>    
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div>No Profile Available</div>
            <?php endif; ?>
        </div>
    </div>
</div>