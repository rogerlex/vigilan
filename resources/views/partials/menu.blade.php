<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('gerenciamento_denuncium_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/denunciacategoria*") ? "c-show" : "" }} {{ request()->is("admin/tags-denuncia*") ? "c-show" : "" }} {{ request()->is("admin/denuncia*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-comment-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.gerenciamentoDenuncium.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('denunciacategorium_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.denunciacategoria.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/denunciacategoria") || request()->is("admin/denunciacategoria/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.denunciacategorium.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tags_denuncium_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tags-denuncia.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tags-denuncia") || request()->is("admin/tags-denuncia/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tagsDenuncium.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('denuncium_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.denuncia.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/denuncia") || request()->is("admin/denuncia/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-comment-dots c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.denuncium.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('gerenc_estabelecimento_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/estabelecimentos*") ? "c-show" : "" }} {{ request()->is("admin/bairros*") ? "c-show" : "" }} {{ request()->is("admin/tipo-estabelecimentos*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-store c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.gerencEstabelecimento.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('estabelecimento_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.estabelecimentos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/estabelecimentos") || request()->is("admin/estabelecimentos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-store c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.estabelecimento.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bairro_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bairros.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bairros") || request()->is("admin/bairros/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marker-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bairro.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tipo_estabelecimento_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tipo-estabelecimentos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipo-estabelecimentos") || request()->is("admin/tipo-estabelecimentos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tipoEstabelecimento.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('ger_processo_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/processos*") ? "c-show" : "" }} {{ request()->is("admin/tipo-processos*") ? "c-show" : "" }} {{ request()->is("admin/tagprocessos*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-file-signature c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.gerProcesso.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('processo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.processos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/processos") || request()->is("admin/processos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-signature c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.processo.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tipo_processo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tipo-processos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipo-processos") || request()->is("admin/tipo-processos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tipoProcesso.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tagprocesso_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tagprocessos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tagprocessos") || request()->is("admin/tagprocessos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tagprocesso.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task-statuses*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.taskManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('task_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.task.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>