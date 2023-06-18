  <div class="navbar-bg" style="background-color: #009D63"></div>
  <nav class="navbar navbar-expand-lg main-navbar">

      <ul class="navbar-nav mr-3 mr-auto">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      </ul>
      <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
                  class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                  <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                  <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->fullname }}</div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">

                  <a href="#" class="dropdown-item has-icon text-danger" onclick="logout(event)">
                      <i class="fas fa-sign-out-alt"></i> Logout
                  </a>

                  <form method="post" action="/logout" id="logout-form">@csrf</form>
              </div>
          </li>
      </ul>
  </nav>
