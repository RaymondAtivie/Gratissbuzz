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
            <li><a href="{{ url('advert/batches') }}">Batches</a></li>
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
            <i class="fa fa-file-text-o"></i><span>View Companies</span>
        </a>
    </li>
    <li class="menu-list">
        <a href="">
            <i class="fa fa-question"></i><span>Send Notifications</span>
        </a>
        <ul class="child-list">
            <li><a href="{{ url('users/messageall') }}">To all Users</a></li>
            <li><a href="{{ url('users/viewall') }}">To specific user</a></li>
        </ul>
    </li>

    
    <li>
        <h3 class="navigation-title">Content Management</h3>
    </li>
     <li>
        <a href="{{url('content/about')}}">
            <i class="fa fa-file-text-o"></i><span>About Us</span>
        </a>
    </li>
     <li>
        <a href="{{url('content/how')}}">
            <i class="fa fa-file-text-o"></i><span>How it Works</span>
        </a>
    </li>
     <li>
        <a href="{{url('content/faq')}}">
            <i class="fa fa-file-text-o"></i><span>FAQ</span>
        </a>
    </li>
     <li>
        <a href="{{url('content/contact')}}">
            <i class="fa fa-file-text-o"></i><span>Contact Us</span>
        </a>
    </li>
     <li>
        <a href="{{url('content/terms')}}">
            <i class="fa fa-file-text-o"></i><span>Terms And Conditions</span>
        </a>
    </li>
     <li>
        <a href="{{url('content/privacy')}}">
            <i class="fa fa-file-text-o"></i><span>Privacy Policy</span>
        </a>
    </li>

    <li>
        <h3 class="navigation-title">Settings</h3>
    </li>
     <li>
        <a href="{{url('settings/questions')}}">
            <i class="fa fa-file-text-o"></i><span>Question Categories</span>
        </a>
    </li>
    <li>
        <a href="{{url('settings/business')}}">
            <i class="fa fa-file-text-o"></i><span>Business Categories</span>
        </a>
    </li>
    <li>
        <a href="{{url('settings/states')}}">
            <i class="fa fa-file-text-o"></i><span>Local Government And States</span>
        </a>
    </li>

</ul>
