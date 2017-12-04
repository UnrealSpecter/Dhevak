<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="/admin">
                Dhevak
            </a>
        </li>
        <div class="divider"></div>
        <li>
            <a href="/admin/projects">Projects</a>
        </li>
        <div class="divider"></div>
        <li>
            <a href="/admin/roles">Roles</a>
        </li>
        <div class="divider"></div>
        <li>
            <a href="/admin/social-media">Social Media</a>
        </li>
        <div class="divider"></div>
        <!-- create logout button -->
        <li>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </li>
      <div class="divider"> </div>
    </ul>
</div>
<!-- /#sidebar-wrapper -->
