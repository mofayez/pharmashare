<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 267px;">
            <div class="card card-blog card-plain card-body direction">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <!--
                                color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                            -->
                            <ul class="nav nav-pills nav-pills-primary nav-pills-just-icons justify-content-center flex-row" role="tablist">
                                <li class="nav-item text-left">
                                    <a class="nav-link active show" data-toggle="tab" href="#link20" role="tablist">
                                        <i class="now-ui-icons users_single-02"></i>
                                    </a>
                                    <h6>{{__('admin.delete_user')}}   </h6>
                                </li>
                                <li class="nav-item text-left">
                                    <a class="nav-link" data-toggle="tab" href="#link21" role="tablist">
                                        <i class="fas fa-user-cog"></i>
                                    </a>
                                    <h6>{{__('admin.activate_user')}}   </h6>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="link20">

                                    <div class="row">
                                        <div class="col-md-12 table-scroll">
                                            <table class="table table-bordered " id="dataTable1">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        {{__('admin.name')}}
                                                    </th>
                                                    <th>
                                                        {{__('admin.user')}}
                                                    </th>
                                                    <th>
                                                        {{__('admin.permission')}}
                                                    </th>
                                                    <th>
                                                        {{__('admin.phone')}}
                                                    </th>
                                                    <th width="150px">
                                                        {{__('admin.rate')}}
                                                    </th>
                                                    <th>
                                                        {{__('admin.status')}}
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($accounts as $account)
                                                    <tr>
                                                        <td>
                                                            {{$account->firstname . ' ' . $account->lastname}}
                                                        </td>
                                                        <td>
                                                            {{$account->username }}
                                                        </td>
                                                        <td>
                                                            {{$account->role->title }}
                                                        </td>
                                                        <td dir="ltr">
                                                            +({{$account->prefix}}) {{$account->phone}}
                                                        </td>
                                                        <td>
                                                            @if($account->role->title == 'store')
                                                                {{$account->averageRating()}}/5
                                                                <a href="" data-toggle="modal"
                                                                   data-user-id="{{$account->id}}"
                                                                   data-target="#showrating_modal"
                                                                   class="text-info">{{__('admin.show')}} </a>
                                                                @if($account->averageRating() == 5)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i>
                                                                    </div>
                                                                @elseif($account->averageRating() > 4 && $account->averageRating() < 5)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star-half-alt"></i>
                                                                    </div>
                                                                @elseif($account->averageRating() == 4)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                @elseif($account->averageRating() > 3 && $account->averageRating() < 4)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star-half-alt"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                @elseif($account->averageRating() == 3)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                @elseif($account->averageRating() > 2 && $account->averageRating() < 3)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star-half-alt"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                @elseif($account->averageRating() == 2)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                @elseif($account->averageRating() > 1 && $account->averageRating() < 2)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star-half-alt"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                @elseif($account->averageRating() == 1)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                @elseif($account->averageRating() > 0 && $account->averageRating() < 1)
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star-half-alt"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                @else
                                                                    <div dir="ltr">
                                                                        <i class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($account->activated)
                                                                <label class="badge badge-success">{{__('admin.activated')}} </label>
                                                            @else
                                                                <label class="badge badge-danger">{{__('admin.not_activated')}}   </label>
                                                            @endif
                                                        </td>
                                                        <td class="p-0">
                                                            @if(count($account->posts) == 0)
                                                            @endif
                                                            @if($account->activated)
                                                            <button class="btn btn-danger p-1 pl-3 pr-3"
                                                                    onclick="deactivate_account('{{$account->id}}')">
                                                                {{__('admin.not_activated')}}
                                                            </button>
                                                            @else
                                                            <button class="btn btn-warning p-1 pl-3 pr-3"
                                                                    onclick="activate_account('{{$account->id}}')">
                                                                {{__('admin.activate')}}
                                                            </button>
                                                            @endif
                                                            <button class="btn btn-danger p-1 pl-3 pr-3"
                                                                    onclick="remove_account('{{$account->id}}')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="link21">
                                    <div class="row">
                                        <div class="col-md-12 table-scroll">
                                            <table class="table table-bordered " id="dataTable2">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        {{__('admin.name')}}
                                                    </th>
                                                    <th>
                                                        {{__('admin.user')}}
                                                    </th>
                                                    <th>
                                                        {{__('admin.permission')}}
                                                    </th>
                                                    <th>
                                                        {{__('admin.phone')}}
                                                    </th>
                                                    <th>
                                                        {{__('admin.details')}}
                                                    </th>
                                                    <th>
                                                        {{__('admin.status')}}
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($disactivated_accounts as $d_account)
                                                    <tr>
                                                        <td>
                                                            {{$d_account->firstname . ' ' . $d_account->lastname}}
                                                        </td>
                                                        <td>
                                                            {{$d_account->username }}
                                                        </td>
                                                        <td>
                                                            {{$d_account->role->title }}
                                                        </td>
                                                        <td dir="ltr">
                                                            +({{$d_account->prefix}}) {{$d_account->phone}}
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-main p-1 pl-3 pr-3" type="button"
                                                                    data-toggle="modal" data-user="{{$d_account}}" 
                                                                    data-role_id="{{$d_account->role->id ?? 0}}"
                                                                    data-trade_license_path="{{$d_account->papers->trade_license_path ?? ''}}"
                                                                    data-passport_license_path="{{$d_account->papers->passport_license_path ?? ''}}"
                                                                    data-pharmacy_license_path="{{$d_account->papers->pharmacy_license_path ?? ''}}"
                                                                    data-target="#showLicense_modal">
                                                                {{__('admin.show_details')}}
                                                            </button>
                                                        </td>
                                                        <td>
                                                            @if($d_account->activated)
                                                                <label class="badge badge-success">
                                                                    {{__('admin.activated')}}
                                                                </label>
                                                            @else
                                                                <label class="badge badge-danger">
                                                                    {{__('admin.not_activated')}}
                                                                </label>
                                                            @endif
                                                        </td>
                                                        <td class="p-0">
                                                            <button class="btn btn-warning p-1 pl-3 pr-3"
                                                                    onclick="activate_account('{{$d_account->id}}')">
                                                                {{__('admin.activate')}}
                                                            </button>
                                                            <button class="btn btn-danger p-1 pl-3 pr-3"
                                                                    onclick="deactivate_account('{{$d_account->id}}')">
                                                                {{__('admin.not_activated')}}
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>