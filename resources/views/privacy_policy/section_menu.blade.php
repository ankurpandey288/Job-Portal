<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body px-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="{{ route('privacy.policy.index', ['section' => 'privacy_policy']) }}"
                           class="nav-link {{ (isset($sectionName) && $sectionName == 'privacy_policy') ? 'active' : ''}}">
                            {{ __('messages.setting.privacy_policy') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('privacy.policy.index', ['section' => 'terms_conditions']) }}"
                           class="nav-link {{ (isset($sectionName) && $sectionName == 'terms_conditions') ? 'active' : ''}}">
                            {{ __('messages.setting.terms_conditions') }}
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

