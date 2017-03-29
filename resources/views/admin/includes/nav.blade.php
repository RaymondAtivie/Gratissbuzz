<ul class="nav nav-pills nav-stacked side-navigation">

    <li>
        <h3 class="navigation-title">Navigation</h3>
    </li>
    <li>
        <a href="{{ url('admin') }}">
            <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
    </li>

    <li>
        <h3 class="navigation-title">Advertisments</h3>
    </li>
     <li>
        <a href="{{url('advert/standardads')}}">
            <i class="fa fa-file-text-o"></i><span>Standard Ads</span>
        </a>
    </li>
    <li class="menu-list">
        <a href="">
            <i class="fa fa-file-text-o"></i><span>Cashless Ads</span>
        </a>
        <ul class="child-list">
            <li><a href="{{ url('advert/pendingAds') }}">Pending Approval</a></li>
            <li><a href="{{ url('advert/approvedAds') }}">Approved</a></li>
            <li><a href="{{ url('advert/liveads') }}">Live Ads</a></li>
        </ul>
    </li>

    <li class="menu-list">
        <a href="">
            <i class="fa fa-file-text-o"></i><span>Promo Info Ads</span>
        </a>
        <ul class="child-list">
            <li><a href="{{ url('advert/pendingPromos') }}">Pending Approval</a></li>
            <li><a href="{{ url('advert/approvedPromos') }}">Approved</a></li>
            <li><a href="{{ url('advert/livepromos') }}">Live Promos</a></li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="fa fa-file-text-o"></i><span>Ad Rates</span>
        </a>
    </li>

    <li>
        <h3 class="navigation-title">Questions & Batches</h3>
    </li>
    <li class="menu-list">
        <a href="">
            <i class="fa fa-question"></i><span>Questions</span>
        </a>
        <ul class="child-list">
            <li><a href="{{ url('question/addCategory') }}">Add Questions Category</a></li>
            <li><a href="{{ url('question/add') }}">Add Questions</a></li>
            <!-- <li><a href="{{ url('question/allocate') }}">Allocate Questions</a></li> -->
            <li><a href="{{ url('question/list') }}">All Questions</a></li>
        </ul>
    </li>

    
    <li>
        <h3 class="navigation-title">User Management</h3>
    </li>
     <li>
        <a href="{{url('users/viewall')}}">
            <i class="fa fa-file-text-o"></i><span>View Users</span>
        </a>
    </li>
     <li>
        <a href="{{url('users/viewvendors')}}">
            <i class="fa fa-file-text-o"></i><span>View Vendors</span>
        </a>
    </li>
    <li class="menu-list">
        <a href="">
            <i class="fa fa-question"></i><span>Send Notifications</span>
        </a>
        <ul class="child-list">
            <li><a href="{{ url('users/messageall') }}">To all Users</a></li>
            <li><a href="{{ url('question/add') }}">To specific user</a></li>
        </ul>
    </li>

   <!-- <li class="menu-list">
        <a href="">
            <i class="fa fa-file-text-o"></i><span>Batches</span>
        </a>
        <ul class="child-list">
            <li><a href="{{ url('batch/create') }}">Create Batches</a></li>
            <li><a href="{{ url('batch/assign') }}">Assign Batches</a></li>
        </ul>
    </li>

    <li>
        <h3 class="navigation-title">Communication</h3>
    </li>

    <li>
        <a href="">
            <i class="fa fa-envelope-o"></i><span>Message All Members</span>
        </a>
        <a href="">
            <i class="fa fa-envelope-o"></i><span>Message All Vendors</span>
        </a>
        <a href="">
            <i class="fa fa-envelope-o"></i><span>Message an Indiviual</span>
        </a>
    </li> -->


</ul>
