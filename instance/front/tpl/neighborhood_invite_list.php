<div class="col-md-12 col-lg-12 ">
    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Neighborhood Invite</b></div>
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
                            <th>User To</th>
                            <th>User From</th>
                            <th>Neighborhood User</th>
                            <th>Invite Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        <?php foreach ($neighborhood as $each_data): ?>
                            <tr>
                                <td><?php print $cr; ?></td>
                                <td><?php
                                    $user_to = qs("SELECT * FROM  user where id='{$each_data['user_id_to']}'");

                                    print $user_to['first_name'];
                                    ?></td>
                                <td><?php   $user_from = qs("SELECT * FROM  user where id='{$each_data['user_id_from']}'");

                                    print $user_from['first_name']; ?></td>
                                <td><?php
                                    $neighborhood_name = qs("SELECT * FROM  neighborhood where id='{$each_data['neighborhood_id']}'");

                                    print $neighborhood_name['name'];
                                    ?></td>
                                <td><?php
                                    if ($each_data['invite_status'] == 0) {
                                        print "Pending";
                                    } elseif ($each_data['invite_status'] == 1) {
                                        print "Accept";
                                    } elseif ($each_data['invite_status'] == 2) {
                                        print "Decline";
                                    }
                                    ?>

                                <td>

                                    <a href="javascript:void(0);" onclick="return DeleteNeighborhoodInvite('neighborhood_invite/delete/<?php print $each_data['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                </td>
                            </tr>
                            <?php $cr++; ?>    
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div>No Neighborhood Invite Available</div>
            <?php endif; ?>
        </div>
    </div>
</div>