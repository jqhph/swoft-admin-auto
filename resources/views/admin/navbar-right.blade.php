<!-- User Account Menu -->
<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        <img  class="user-image">
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">Swoft admin</span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user imagez in the menu -->
        <li class="user-header">
            <img  class="img-circle" >
            <p>
                Swoft admin
                <small>Member since admin 2018-09-11</small>
            </p>
        </li>
        <li class="user-footer">
            <div class="pull-left">
                <a href="{{ admin_base_path('auth/setting') }}" class="btn btn-default btn-flat">{{ t('Setting', 'admin') }}</a>
            </div>
            <div class="pull-right">
                <a href="{{ admin_base_path('auth/logout') }}" class="btn btn-default btn-flat">{{ t('Logout', 'admin') }}</a>
            </div>
        </li>
    </ul>
</li>