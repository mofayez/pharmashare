<style>
    .form-check .form-check-label {
        padding-left: 0px;
        padding-right: 35px;
    }

    .form-check .form-check-sign:after, .form-check .form-check-sign:before {
        right: 0;
        left: auto;
    }
</style>
<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.setting.navigators')
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">

                                <div class="col-md-12 text-left">
                                    <h3>   {{__('settings.contact_us')}}  </h3>
                                </div>
                                <div class="col-md-12 table-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th> {{__('settings.name')}} </th>
                                            <th>{{__('settings.phone')}}</th>
                                            <th> {{__('settings.message')}}  </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($contacts as $contact)
                                            <tr>
                                                <td>{{$contact->name}}</td>
                                                <td>{{$contact->phone}}</td>
                                                <td>{{$contact->message}}</td>
                                                <td>
                                                    <button class="btn btn-danger p-1 pr-2 pl-2"
                                                            onclick="deleteMessage('{{$contact->id}}')">
                                                        <i class="fa fa-times"></i>
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