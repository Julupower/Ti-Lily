        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">User</li>

                    <li class="nav-item">
                        <a href="{{route('userDashboard')}}" class="nav-link {{Route::currentRouteName() == 'userDashboard' ? 'active' : ''}}">
                            <i class="icon icon-settings"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a href="{{route('userComments')}}" class="nav-link {{Route::currentRouteName() == 'userComments' ? 'active' : ''}}">
                            <i class="icon icon-bubble"></i> Comments
                        </a>
                    </li>
                    <!-- only display if the user has access to this section -->
                    @if(Auth::user()->author == true)
                    <li class="nav-title">Author</li>

                    <li class="nav-item nav-dropdown">
                        <a href="{{route('authorDashboard')}}" class="nav-link {{Route::currentRouteName() == 'authorDashboard' ? 'active' : ''}}">
                            <i class="icon icon-settings"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a href="{{route('authorPost')}}" class="nav-link {{Route::currentRouteName() == 'authorPost' ? 'active' : ''}}">
                            <i class="icon icon-paper-clip"></i> Post
                        </a>
                    </li>
 
                    <li class="nav-item nav-dropdown">
                        <a href="{{route('authorComments')}}" class="nav-link {{Route::currentRouteName() == 'authorComments' ? 'active' : ''}}">
                            <i class="icon icon-bubble"></i> Comments
                        </a>
                    </li>
                    @endif
                    
                    <!-- only display if the user has access to this section -->
                    @if(Auth::user()->admin == true)
                    <li class="nav-title">Admin</li>
                    <li class="nav-item nav-dropdown">
                        <a href="{{route('adminDashboard')}}" class="nav-link {{Route::currentRouteName() == 'adminDashboard' ? 'active' : ''}}">
                            <i class="icon icon-settings"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item nav-dropdown">
                        <a href="{{route('adminProducts')}}" class="nav-link {{Route::currentRouteName() == 'adminProducts' ? 'active' : ''}}">
                            <i class="icon icon-basket-loaded"></i> Products
                        </a>
                    </li>
                    
                    <li class="nav-item nav-dropdown">
                        <a href="{{route('adminPost')}}" class="nav-link {{Route::currentRouteName() == 'adminPost' ? 'active' : ''}}">
                            <i class="icon icon-paper-clip"></i> Post
                        </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a href="{{route('adminComments')}}" class="nav-link {{Route::currentRouteName() == 'adminComments' ? 'active' : ''}}">
                            <i class="icon icon-bubble"></i> Comments
                        </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a href="{{route('adminUsers')}}" class="nav-link {{Route::currentRouteName() == 'adminUsers' ? 'active' : ''}}">
                            <i class="icon icon-user"></i> Users
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>