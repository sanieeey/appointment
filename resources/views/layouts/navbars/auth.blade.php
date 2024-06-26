<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/mee.jpg">
            </div>
        </a>
            @if(auth()->check())
            <span class="simple-text" style="float: center; color: #black; padding: 14px 16px;">
                {{ auth()->user()->name }}({{ auth()->user()->role }})
            </span>
            @endif
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <!-- <i class="nc-icon nc-bank"></i> -->
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <!-- <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                            {{ __('PROFILE') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav"> -->
                        <!-- <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li> -->
                        <!-- <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li> -->
                    <!-- </ul>
                </div>
            </li> -->
            <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <!-- <span class="sidebar-mini-icon">{{ __('UP') }}</span> -->
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
            <!-- <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' Add Patient ') }}</span>
                            </a>
                        </li> -->
            <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'icons') }}">
                    <!-- <i class="nc-icon nc-diamond"></i> -->
                    <p>{{ __('APPOINTMENTS') }}</p>
                </a>
            </li>
            <!-- <li class="{{ $elementActive == 'map' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'map') }}">
                    <i class="nc-icon nc-pin-3"></i> -->
                    <!-- <p>{{ __('ADD DOCTORS') }}</p>
                </a>
            </li> -->
            
            <!-- <li class="{{ $elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'notifications') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li> -->
            <!-- <li class="{{ $elementActive == 'tables' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'tables') }}">
                    <p>{{ __('PATIENTS') }}</p>
                </a>
            </li> -->
            <li class="{{ $elementActive == 'typography' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'typography') }}">
                    <!-- <i class="nc-icon nc-caps-small"></i> -->
                    <p>{{ __('DOCTORS') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'notifications') }}">
                    <!-- <i class="nc-icon nc-bell-55"></i> -->
                    <p>{{ __('HISTORY') }}</p>
                </a>
            </li>
            <li class="active-pro {{ $elementActive == 'upgrade' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'upgrade') }}" class="bg-danger">
                    <!-- <i class="nc-icon nc-spaceship text-white"></i> -->
                    <p class="text-white">{{ __('LOGOUT') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
