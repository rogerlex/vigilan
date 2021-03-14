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
        @can('visitum_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.visita.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/visita") || request()->is("admin/visita/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-table c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.visitum.title') }}
                </a>
            </li>
        @endcan
        @can('atividade_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.atividades.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/atividades") || request()->is("admin/atividades/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.atividade.title') }}
                </a>
            </li>
        @endcan
        @can('baixaduam_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.baixaduams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/baixaduams") || request()->is("admin/baixaduams/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.baixaduam.title') }}
                </a>
            </li>
        @endcan
        @can('estabelecimento_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.estabelecimentos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/estabelecimentos") || request()->is("admin/estabelecimentos/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-store c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.estabelecimento.title') }}
                </a>
            </li>
        @endcan
        @can('pendencium_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.pendencia.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pendencia") || request()->is("admin/pendencia/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-check-double c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pendencium.title') }}
                </a>
            </li>
        @endcan
        @can('processo_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.processos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/processos") || request()->is("admin/processos/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.processo.title') }}
                </a>
            </li>
        @endcan
        @can('reg_denuncium_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.reg-denuncia.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reg-denuncia") || request()->is("admin/reg-denuncia/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-comment c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.regDenuncium.title') }}
                </a>
            </li>
        @endcan
        @can('cadastro_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/cargos*") ? "c-show" : "" }} {{ request()->is("admin/categoria*") ? "c-show" : "" }} {{ request()->is("admin/bairros*") ? "c-show" : "" }} {{ request()->is("admin/formacaos*") ? "c-show" : "" }} {{ request()->is("admin/origens*") ? "c-show" : "" }} {{ request()->is("admin/statuses*") ? "c-show" : "" }} {{ request()->is("admin/tags*") ? "c-show" : "" }} {{ request()->is("admin/tipoestabelecimentos*") ? "c-show" : "" }} {{ request()->is("admin/tipos-processos*") ? "c-show" : "" }} {{ request()->is("admin/colaboradores*") ? "c-show" : "" }} {{ request()->is("admin/identidadegeneros*") ? "c-show" : "" }} {{ request()->is("admin/departamentos*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.cadastro.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('cargo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cargos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cargos") || request()->is("admin/cargos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cargo.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('categorium_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.categoria.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/categoria") || request()->is("admin/categoria/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.categorium.title') }}
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
                    @can('formacao_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.formacaos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/formacaos") || request()->is("admin/formacaos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.formacao.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('origen_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.origens.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/origens") || request()->is("admin/origens/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marked-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.origen.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/statuses") || request()->is("admin/statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.status.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tags") || request()->is("admin/tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tipoestabelecimento_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tipoestabelecimentos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipoestabelecimentos") || request()->is("admin/tipoestabelecimentos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tipoestabelecimento.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tipos_processo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tipos-processos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipos-processos") || request()->is("admin/tipos-processos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tiposProcesso.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('colaboradore_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.colaboradores.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/colaboradores") || request()->is("admin/colaboradores/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-lock c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.colaboradore.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('identidadegenero_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.identidadegeneros.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/identidadegeneros") || request()->is("admin/identidadegeneros/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-male c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.identidadegenero.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('departamento_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.departamentos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/departamentos") || request()->is("admin/departamentos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-address-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.departamento.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
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