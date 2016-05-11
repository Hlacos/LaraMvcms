<ul class="sidebar-menu">
    <li class="header">{{ trans('lara-mvcms::menu.title') }}</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ hasRoute('lara-mvcms.dashboard') ? 'active' : '' }}">
        <a href="{{ route('lara-mvcms.dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('lara-mvcms::menu.dashboard') }}</span></a>
    </li>
    @if (hasPermissions(['manage-permissions', 'manage-roles', 'manage-admin-users'], 'or'))
        <li class="treeview{{ hasRoute('lara-mvcms.administration') ? ' active' : '' }}">
            <a href="#"><i class="fa fa-gear"></i> <span>{{ trans('lara-mvcms::menu.administration') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                @if (hasPermission('manage-permissions'))
                    <li class="{{ hasRoute('lara-mvcms.administration.permissions') ? 'active' : '' }}">
                        <a href="{{ route('lara-mvcms.administration.permissions.index') }}">
                            <i class="fa fa-lock"></i> <span>{{ trans('lara-mvcms::menu.permissions') }}</span>
                        </a>
                    </li>
                @endif
                @if (hasPermission('manage-roles'))
                    <li class="{{ hasRoute('lara-mvcms.administration.roles') ? 'active' : '' }}">
                        <a href="{{ route('lara-mvcms.administration.roles.index') }}">
                            <i class="fa fa-group"></i> <span>{{ trans('lara-mvcms::menu.roles') }}</span>
                        </a>
                    </li>
                @endif
                @if (hasPermission('manage-admin-users'))
                    <li class="{{ hasRoute('lara-mvcms.administration.admin-users') ? 'active' : '' }}">
                        <a href="{{ route('lara-mvcms.administration.admin-users.index') }}">
                            <i class="fa fa-user"></i> <span>{{ trans('lara-mvcms::menu.admin-users') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if (hasPermissions(['manage-pages', 'manage-galleries'], 'or'))
        <li class="treeview{{ hasRoute('lara-mvcms.content-management') ? ' active' : '' }}">
            <a href="#"><i class="fa fa-globe"></i> <span>{{ trans('lara-mvcms::menu.content-management') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                @if (hasPermission('manage-pages'))
                    <li class="{{ hasRoute('lara-mvcms.content-management.pages') ? 'active' : '' }}">
                        <a href="{{ route('lara-mvcms.content-management.pages.index') }}">
                            <i class="fa fa-file"></i> <span>{{ trans('lara-mvcms::menu.pages') }}</span>
                        </a>
                    </li>
                @endif
                @if (hasPermission('manage-galleries'))
                    <li class="{{ hasRoute('lara-mvcms.content-management.galleries') ? 'active' : '' }}">
                        <a href="{{ route('lara-mvcms.content-management.galleries.index') }}">
                            <i class="fa fa-file-image-o"></i> <span>{{ trans('lara-mvcms::menu.galleries') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if (hasPermissions(['manage-categories', 'manage-tags', 'manage-posts'], 'or'))
        <li class="treeview{{ hasRoute('lara-mvcms.blog') ? ' active' : '' }}">
            <a href="#"><i class="fa fa-globe"></i> <span>{{ trans('lara-mvcms::menu.blog') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                @if (hasPermission('manage-categories'))
                    <li class="{{ hasRoute('lara-mvcms.blog.categories') ? 'active' : '' }}">
                        <a href="{{ route('lara-mvcms.blog.categories.index') }}">
                            <i class="fa fa-file"></i> <span>{{ trans('lara-mvcms::menu.categories') }}</span>
                        </a>
                    </li>
                @endif
                @if (hasPermission('manage-tags'))
                    <li class="{{ hasRoute('lara-mvcms.blog.tags') ? 'active' : '' }}">
                        <a href="{{ route('lara-mvcms.blog.tags.index') }}">
                            <i class="fa fa-file-image-o"></i> <span>{{ trans('lara-mvcms::menu.tags') }}</span>
                        </a>
                    </li>
                @endif
                @if (hasPermission('manage-posts'))
                    <li class="{{ hasRoute('lara-mvcms.blog.posts') ? 'active' : '' }}">
                        <a href="{{ route('lara-mvcms.blog.posts.index') }}">
                            <i class="fa fa-file-image-o"></i> <span>{{ trans('lara-mvcms::menu.posts') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
</ul>
