<ul class="sidebar-menu">
    <!-- Optionally, you can add icons to the links -->
<!--        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
    <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->
    <li class="treeview">
        <a href=""><i class="fa fa-link"></i> <span>Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{URL::to('/users')}}">List users</a></li>
            <li><a href="{{URL::to('/users/create')}}">Add new</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href=""><i class="fa fa-link"></i> <span>Categories</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{URL::to('/categories')}}">List categories</a></li>
            <li><a href="{{URL::to('/categories/create')}}">Add new</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href=""><i class="fa fa-link"></i> <span>Foods</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{URL::to('/foods')}}">List foods</a></li>
            <li><a href="{{URL::to('/foods/create')}}">Add new</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href=""><i class="fa fa-link"></i> <span>Pages</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{URL::to('/pages')}}">List pages</a></li>
            <li><a href="{{URL::to('/pages/create')}}">Add page</a></li>
        </ul>
    </li>
</ul>