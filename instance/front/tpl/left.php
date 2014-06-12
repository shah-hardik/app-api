<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php print _U; ?>" style="color:#ADDFFF;">
            NEIGHBORING APP
        </a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php l('users') ?>">Users List</a></li>
                    <li><a href="<?php l('alerts') ?>">Alert</a></li>
                    <li><a href="<?php l('profile') ?>">Profile</a></li>
                    <li><a href="<?php l('states') ?>">States</a></li>

                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Post <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php l('post') ?>">User's Post </a></li>
                    <li><a href="<?php l('post_like') ?>">Post like </a></li>
                    <li><a href="<?php l('post_comment') ?>">Post Comment</a></li>


                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Service Provider <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php l('service_provider') ?>">Service Provider</a></li>
                    <li><a href="<?php l('service_provider_cat') ?>">Service Provider Category</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Neighborhood <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php l('neighborhood') ?>">Neighborhood List</a></li>
                    <li><a href="<?php l('neighborhood_invite') ?>">Neighborhood Invite</a></li>

                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php l('login?logout=1') ?>">Logout <i class="glyphicon glyphicon-off"></i></a></li>

        </ul>
    </div>
</nav>


