<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="javascript:void(0)" class="app-brand-link">
        <span class="app-brand-logo demo me-1">
          <span style="color: var(--bs-primary)">
              <img src="{{asset('assets/images/logo.png')}}" alt="manifest" style="width: 150px;" >
          </span>
        </span>
        <span class="app-brand-text demo menu-text fw-semibold ms-2"></span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
    @if(Auth::user()->user_type != '0')
          <li class="menu-item {{Request::segment(2) == 'dashboard' ? 'active' : ''  }}">
            <a href="{{url('/admin/dashboard')}}" class="menu-link">
              <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
              <div data-i18n="Support">Dashboard</div>
            </a>
          </li>
          <?php
          $childs = Helper::get_user_permission();
          $permissions = DB::table('action_masters')
              ->whereIn('id', $childs)
              ->where('parent_id', 0)
              ->orderBy('display_order', 'desc')
              ->get();
          ?>
          @foreach ($permissions as $item)
              @if ($item->action == '/user')
                  <?php $active = 'admin/user'; ?>
              @endif
              @if ($item->action == '/role')
                  <?php $active = 'admin/role'; ?>
              @endif

              {{-- <li class="nav-item @if (Session::get('active') == '{{ $item->action_title }}') active @endif">
                <a class="nav-link" href="{{ url($active) }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">{{ $item->action_title }}</span>
                </a>
            </li> --}}
            <li class="menu-item @if (Session::get('active') == '{{ $item->action_title }}') active @endif">
                <a
                  href="{{ url($active) }}"
                  class="menu-link">
                  <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                  <div data-i18n="Support">{{ $item->action_title }}</div>
                </a>
              </li>




              @endforeach

            {{-- student --}}

          {{-- teacher --}}

           {{-- teacher --}}
    @else
      <li class="menu-item {{Request::segment(2) == 'dashboard' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/dashboard')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Dashboard</div>
        </a>
      </li>
      <li class="menu-item @if(in_array(Request::segment(2), ['state', 'city','time_zones','questions','question-options','city','zipcode'])) open @endif">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
          <div data-i18n="Masters">PickList</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item {{Request::segment(2) == 'state' ? 'active' : ''  }}">
            <a href="{{ route('admin.state') }}" class="menu-link">
              <div data-i18n="State Master">State</div>
            </a>
          </li>

          <li class="menu-item {{Request::segment(2) == 'city' ? 'active' : ''  }}">
            <a href="{{ route('admin.city') }}" class="menu-link">
              <div data-i18n="City Master">City</div>
            </a>
          </li>
          <li class="menu-item {{Request::segment(2) == 'time_zones' ? 'active' : ''  }}">
            <a href="{{ route('admin.time_zones') }}" class="menu-link">
              <div data-i18n="TimeZone Master">Time Zone</div>
            </a>
          </li>
          <li class="menu-item {{Request::segment(2) == 'zipcode' ? 'active' : ''  }}">
            <a href="{{ route('admin.zipcode') }}" class="menu-link">
              <div data-i18n="zipcode Master">Zip Code</div>
            </a>
          </li>
          <li class="menu-item {{Request::segment(2) == 'questions' ? 'active' : ''  }}">
            <a href="{{ route('admin.questions') }}" class="menu-link">
              <div data-i18n="questions Master">Questionnaire</div>
            </a>
          </li>
          {{-- <li class="menu-item {{Request::segment(2) == 'email' ? 'active' : ''  }}">
            <a href="{{ route('admin.email') }}" class="menu-link">
              <div data-i18n="Landing">Email Template</div>
            </a>
          </li> --}}
        </ul>
      </li>
      <!-- Front Pages -->

      {{-- <li class="menu-item @if(in_array(Request::segment(2), ['user', 'user-permission'])) open @endif"> --}}
      <li class="menu-item @if(in_array(Request::segment(2), ['role','user'])) open @endif">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons mdi mdi-flip-to-front"></i>
          <div data-i18n="Utility">User Manager</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{Request::segment(2) == 'role' ? 'active' : ''  }}">
            <a href="{{ route('admin.role') }}" class="menu-link">
              <div data-i18n="Landing">Roles & Permissions</div>
            </a>
          </li>
          <li class="menu-item {{Request::segment(2) == 'user' ? 'active' : ''  }}">
            <a href="{{ route('admin.user') }}" class="menu-link">
              <div data-i18n="Landing">User Listing</div>
            </a>
          </li>
          {{-- <li class="menu-item {{Request::segment(2) == 'user-permission' ? 'active' : ''  }}">
            <a href="{{url('/admin/user-permission')}}" class="menu-link">
              <div data-i18n="Pricing">User Permission</div>
            </a>
          </li> --}}
          {{-- <li class="menu-item {{Request::segment(2) == 'change-password' ? 'active' : ''  }}">
              <a href="{{url('/admin/change-password')}}" class="menu-link">
                <div data-i18n="Pricing">Change Password</div>
              </a>
            </li> --}}
        </ul>
      </li>
      <li class="menu-item {{Request::segment(2) == 'students' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/students')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Student Manager</div>
        </a>
      </li>

      <li class="menu-item {{Request::segment(2) == 'teachers' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/teachers')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Teacher Manager</div>
        </a>
      </li>
      <li class="menu-item {{Request::segment(2) == 'courses' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/courses')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Courses Manager</div>
        </a>
      </li>
      <li class="menu-item {{Request::segment(2) == 'payments' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/payments')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Payments Manager</div>
        </a>
      </li>

      <!-- <li class="menu-item {{Request::segment(2) == 'group-class' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/group-class')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Student List</div>
        </a>
      </li> -->
      <li class="menu-item {{Request::segment(2) == 'batch' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/batch')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Active Classes</div>
        </a>
      </li>

      <li class="menu-item {{Request::segment(2) == 'finish-current-course' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/finish-current-course')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Course Approval</div>
        </a>
      </li>
      <li class="menu-item {{Request::segment(2) == 'support' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/support')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Cancellation Approval</div>
        </a>
      </li>
      <li class="menu-item {{Request::segment(2) == 'email' ? 'active' : ''  }}">
        <a
          href="{{url('/admin/email')}}"
          class="menu-link">
          <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
          <div data-i18n="Support">Email Template</div>
        </a>
      </li>
      @endif
    </ul>
  </aside>
