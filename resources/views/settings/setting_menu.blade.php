<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body px-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="{{ route('settings.index', ['section' => 'general']) }}"
                           class="nav-link {{ (isset($sectionName) && $sectionName == 'general') ? 'active' : ''}}">
                            {{ __('messages.general') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('settings.index', ['section' => 'front_office_details']) }}"
                           class="nav-link {{ (isset($sectionName) && $sectionName == 'front_office_details') ? 'active' : ''}}">
                            {{ __('messages.footer_settings') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('settings.index', ['section' => 'social_settings']) }}"
                           class="nav-link {{ (isset($sectionName) && $sectionName == 'social_settings') ? 'active' : ''}}">
                            {{ __('messages.social_settings') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('settings.index', ['section' => 'about_us']) }}"
                           class="nav-link {{ (isset($sectionName) && $sectionName == 'about_us') ? 'active' : ''}}">
                            {{ __('messages.about_us') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('settings.index', ['section' => 'env_setting']) }}"
                           class="nav-link {{ (isset($sectionName) && $sectionName == 'env_setting') ? 'active' : ''}}">
                            {{ __('messages.env') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        @yield('section')
    </div>
</div>

