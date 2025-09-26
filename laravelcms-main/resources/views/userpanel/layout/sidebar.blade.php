<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="/avatars/{{ Auth::user()->avatar }}" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{Auth::user()->username}}</p>
                  <p class="designation">{{Auth::user()->usertype}}</p>
                </div>
              </a>
            </li>
          
      

        
          

            <li class="nav-item">

          <?php  $usertype = Auth::user()->usertype ?>

            @if($usertype=="user")
            
            @elseif($usertype=="useradmin")

            @else
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="menu-icon typcn typcn-coffee"></i>
                            <span class="menu-title">User List </span>
                            <i class="menu-arrow"></i>
                          </a>
                          <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                              <li class="nav-item">
                                <a class="nav-link" href="{{route('getalluser')}}">All User </a>
                              </li>
                        
                            </ul>
                          </div>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link" href="pages/forms/basic_elements.html">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Add Category</span>
                          </a>
                        </li>
            @endif

          
       
        
            </li>
         
         
          </ul>
        </nav>