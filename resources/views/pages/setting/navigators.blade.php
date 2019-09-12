<ul class="nav nav-pills nav-pills-primary flex-column">
    <li class="nav-item">
        <a class="nav-link @if($nav == 1) active show @endif" href="{{route('getProfileSettingView')}}">
            {{__('settings.personal_info')}}
        </a>
    </li>
    @if(auth()->user()->role_id == 2)
        <li class="nav-item">
            <a class="nav-link @if($nav == 2) active show @endif" href="{{route('getPaymentsSettingView')}}">
                {{__('settings.payment_types')}}
            </a>
        </li>
    @endif
    @if(auth()->user()->role_id != 1)
        <li class="nav-item">
            <a class="nav-link @if($nav == 3) active show @endif" href="{{route('getEditLicensesView')}}">
                {{__('settings.edit_licenses')}}
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link @if($nav == 4) active show @endif" href="{{route('getNotificationsSettingView')}}">
            {{__('settings.notifications')}}
        </a>
    </li>
    @if(auth()->user()->role_id == 3)
        <li class="nav-item">
            <a class="nav-link @if($nav == 5) active show @endif" href="{{route('getPharmacyBlacklist')}}">
                {{__('settings.black_list')}}
            </a>
        </li>
    @endif
    @if(auth()->user()->role_id == 2)
        <li class="nav-item">
            <a class="nav-link @if($nav == 5) active show @endif" href="{{route('getStoreBlacklist')}}">
                {{__('settings.black_list')}}
            </a>
        </li>
    @endif
    @if(auth()->user()->role_id == 1)
        <li class="nav-item">
            <a class="nav-link @if($nav == 6) active show @endif" href="{{route('getHeaderSite')}}">
                {{__('settings.out_site')}}
            </a>
        </li>
    @endif
    @if(auth()->user()->role_id == 1)
        <li class="nav-item">
            <a class="nav-link @if($nav == 7) active show @endif" href="{{route('getContactUs')}}">
                {{__('settings.contact_us')}}
            </a>
        </li>
    @endif
    @if(auth()->user()->role_id == 1)
        <li class="nav-item">
            <a class="nav-link @if($nav == 11) active show @endif" href="{{route('getDefaultSettings')}}">
                {{app()->getLocale() == 'ar' ? 'الاعدادات العامة' : 'Default Settings'}}
            </a>
        </li>
    @endif
    @if(auth()->user()->role_id == 1)
        <li class="nav-item">
            <a class="nav-link @if($nav == 8) active show @endif" href="{{route('getComplaintsUs')}}">
                {{__('settings.complaints')}}
            </a>
        </li>
    @endif
    @if(auth()->user()->role_id != 1)
        <li class="nav-item">
            <a class="nav-link @if($nav == 9) active show @endif" href="{{route('getCreateComplaintsUs')}}">
                {{__('settings.complaints')}}
            </a>
        </li>
    @endif
    @if(auth()->user()->role_id == 1)
        <li class="nav-item">
            <a class="nav-link @if($nav == 10) active show @endif" href="{{route('getAdsControl')}}">
                {{__('settings.ads_control')}}
            </a>
        </li>
    @endif
</ul>