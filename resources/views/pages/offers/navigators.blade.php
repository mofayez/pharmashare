<ul class="nav nav-pills nav-pills-primary flex-column">
    @if($user->role_id == 2)
        <li class="nav-item">
            <a class="nav-link @if($nav == 2) active show @endif" href="{{route('getAddDrugsOffersView')}}">
                {{__('admin.add_feature_ads')}}
            </a>
        </li>
    @endif
    @if($user->role_id == 1 || $user->role_id == 2 || $user->role_id == 3)
        <li class="nav-item">
            <a class="nav-link @if($nav == 1) active show @endif" href="{{route('getAddImageOffersView')}}">
                {{__('admin.add_image_ads')}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($nav == 3) active show @endif" href="{{route('getAllUserOffersView')}}">
                {{__('admin.show_my_ads')}}
            </a>
        </li>
    @endif
    @if($user->role_id == 1)
        <li class="nav-item">
            <a class="nav-link @if($nav == 6) active show @endif" href="{{route('getAddOfferPackagesView')}}">
                {{__('admin.add_package')}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($nav == 4) active show @endif" href="{{route('getOfferPackagesView')}}">
                {{__('admin.packages')}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($nav == 5) active show @endif" href="{{route('getApproveOffersView')}}">
                {{__('admin.accept_ads')}}
            </a>
        </li>
    @endif
</ul>