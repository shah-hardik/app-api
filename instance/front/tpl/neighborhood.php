<div  class="moduleActionBar col-lg-12 col-md-12">
    <div>
        <nav class="navbar navbar-default " role="navigation">
            <div class="collapse navbar-collapse navbar-ex1-collapse  ">
                <ul class="nav navbar-nav">
                    <li class="<?php print $activeMenuList ?>"><a href="<?php print _U ?>neighborhood/list"><i class="glyphicon glyphicon-th-list"></i>&nbsp;List Neighborhoods</a></li>
		    <li class="<?php print $activeMenuAdd ?>"><a href="<?php print _U ?>neighborhood/add"><i class="glyphicon glyphicon-<?php print $addIcon?>"></i>&nbsp;<?php print $addLabel?></a></li>
		    <li class="disabled"><a href="#"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete Neighborhood(s)</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="clearfix "></div>

<div class="clearfix "></div>
<?php include $subTpl; ?>

<?php include_once('message.php') ?>
