<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Service Provider</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($service_provider)):
                ?>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Location Latitude</th>
                            <th>Location Longitude</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        <?php foreach ($service_provider as $each_data): ?>
                            <tr>
                                <td><?php print $cr; ?></td>
                                <td><?php print $each_data['name']; ?></td>
                                <td><?php
                                    $service = qs("select * from service_provider_has_service_provider_category where service_provider_id = '{$each_data['id']}'");
                                    $category = qs("select * from service_provider_category where id = '{$service['service_provider_category_id']}'");

                                    print $category['name'];
                                    ?></td>

                                <td><?php print $each_data['location_latitude']; ?></td>
                                <td><?php print $each_data['location_longitude']; ?></td>
                                <td>
                                    <a href="<?php print _U ?>service_provider/edit/<?php print $each_data['id']; ?>"><i class="glyphicon glyphicon-edit" title="Edit"></i></a>
                                    <a href="javascript:void(0);" on onclick="return DeleteServiceProvider('service_provider/delete/<?php print $each_data['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                </td>
                            </tr>
                            <?php $cr++; ?>    
    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div>No Service Provider Available</div>
<?php endif; ?>
        </div>
    </div>
</div>

