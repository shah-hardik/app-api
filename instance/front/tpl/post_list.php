<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Posts</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($post)):
                ?>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Type of Post</th>
                            <th>Text</th>
                            <th>Post</th>
                            <th>No of like</th>
                            <th>No of Comments</th>
                            <th>Media</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        <?php foreach ($post as $each_post): ?>
                            <tr>
                                <td><?php print $cr; ?></td>
                                <td><?php
                                    $user = qs("select * from user where id='{$each_post['user_id']}'");
                                    print $user['first_name'];
                                    ?></td>
                                <td><?php print $each_post['type']; ?></td>
                                <td><?php print $each_post['text']; ?></td>
                                <td>
                                    <img src="<?php print _MEDIA_URL . "img/" . $each_post['thumbnail']; ?>" width="100"  />
                                </td>
                                <td><?php print $each_post['likes_count']; ?></td>
                                <td><?php print $each_post['comments_count']; ?></td>
                                <td><?php print $each_post['media']; ?></td>

                                <td>
                                    <a href="<?php print _U ?>post/edit/<?php print $each_post['id']; ?>"><i class="glyphicon glyphicon-edit" title="Edit"></i></a>
                                    <a href="javascript:void(0);" onclick="return DeletePost('post/delete/<?php print $each_post['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                </td>
                            </tr>
                            <?php $cr++; ?>    
    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div>No Post Available</div>
<?php endif; ?>
        </div>
    </div>
</div>