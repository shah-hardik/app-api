<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Post Like</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($post_like)):
                ?>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Post Type</th>
                            <th>User Name</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        <?php foreach ($post_like as $each_post): ?>
                            <tr>
                                <td><?php print $cr; ?></td>
                                <td><?php 
                                $post = qs("select * from post where id='{$each_post['post_id']}'");
                                print $post['type']; ?></td>

                                <td><?php
                                    $user = qs("select * from user where id='{$each_post['user_id']}'");
                                    print $user['first_name'];
                                    ?></td>


                                <td>
                                    <a href="javascript:void(0);" onclick="return DeletePostLike('post_like/delete/<?php print $each_post['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                </td>
                            </tr>
                            <?php $cr++; ?>    
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div>No Post Like Available</div>
            <?php endif; ?>
        </div>
    </div>
</div>