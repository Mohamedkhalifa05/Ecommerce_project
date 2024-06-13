<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        Khalifa<span>Dash</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('Admin_Dashboard')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">RealState</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">PropertyType</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="emails">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.types')}}" class="nav-link">All Type</a>
              </li>
              <li class="nav-item">
                <a href="{{route('add.type')}}" class="nav-link">Add Type</a>
              </li>
              
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Property State</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="emails">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.state')}}" class="nav-link">All State</a>
              </li>
              <li class="nav-item">
                <a href="{{route('add.state')}}" class="nav-link">Add State</a>
              </li>
              
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#Amenitie" role="button" aria-expanded="false" aria-controls="Amenitie">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Amenities</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Amenitie">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.Amenities')}}" class="nav-link"> All Amenities</a>
              </li>
              <li class="nav-item">
                <a href="{{route('add.amenitie')}}" class="nav-link">Add Amenitie</a>
              </li>
              
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false" aria-controls="Amenitie">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Property</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="property">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.Properties')}}" class="nav-link"> All Properties</a>
              </li>
              <li class="nav-item">
                <a href="{{route('add.Property')}}" class="nav-link">Add Property</a>
              </li>

              
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="{{route('admin.package.history')}}"  >
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Package History</span>
           
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="{{route('admin.property.message')}}"  >
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Property Message</span>
           
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#testimonials" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Manage Testimonials</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="testimonials">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.testimonals')}}" class="nav-link">All Testimonials</a>
              </li>
              <li class="nav-item">
                <a href="{{route('add.testimonals')}}" class="nav-link">Add Testimonials</a>
              </li>
              
            </ul>
          </div>
       
        {{-- <li class="nav-item">
          <a href="pages/apps/chat.html" class="nav-link">
            <i class="link-icon" data-feather="message-square"></i>
            <span class="link-title">Chat</span>
          </a>
        </li> --}}
       
        <li class="nav-item nav-category">User All Functions</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
            <i class="link-icon" data-feather="feather"></i>
            <span class="link-title">Mange Agent</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="uiComponents">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.agents')}}" 
                class="nav-link">All agent</a>
              </li>
              <li class="nav-item">
                <a href="{{route('add.agent')}}"
                 class="nav-link">Add agent</a>
              </li>
            
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#BlogCategory" role="button" aria-expanded="false" aria-controls="uiComponents">
            <i class="link-icon" data-feather="feather"></i>
            <span class="link-title">All Blog Category</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="uiComponents">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.blog.category')}}" 
                class="nav-link">All Blog Category</a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{route('add.agent')}}"
                 class="nav-link">Add agent</a>
              </li> --}}
            
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Advanced UI</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="advancedUI">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="pages/advanced-ui/cropper.html" class="nav-link">Cropper</a>
              </li>
              <li class="nav-item">
                <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Owl carousel</a>
              </li>
              <li class="nav-item">
                <a href="pages/advanced-ui/sortablejs.html" class="nav-link">SortableJs</a>
              </li>
              <li class="nav-item">
                <a href="pages/advanced-ui/sweet-alert.html" class="nav-link">Sweet Alert</a>
              </li>
            </ul>
          </div>
        </li>
        
        <li class="nav-item nav-category">Docs</li>
        <li class="nav-item">
          <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
            <i class="link-icon" data-feather="hash"></i>
            <span class="link-title">Documentation</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  