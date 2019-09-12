<style>
    .my-group input {
        height: 30px !important;
        max-width: 25% !important;
    }

    .my-group .btn-main {
        height: 30px !important;
        max-width: 10% !important;
    }

    #map {
        width: 100%;
        height: 50vh;
        position: relative;
        display: flex;
    }

</style>
<div class="card" style="min-height: 300px">
    <div class="card card-blog card-plain card-body">

        <div class="row">
            <div class="col-md-8">
                <h2>{{__('jobs.all_jobs')}} </h2> 
            </div>
            <div class="col-md-4">
                @if($user->role_id != 4)
                    <div class="float-right">
                       <a href="{{route('getPostJobsView')}}" class="btn btn-main">
                            {{__('jobs.add_job')}}
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-12 table-scroll">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{__('jobs.job_title')}} </th>
                        <th>{{__('jobs.salary')}} </th>
                        <th>{{__('jobs.created_at')}}   </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{$job->job_name}}</td>
                            <td>
                                {{$job->salary}} - {{$job->max_salary}}
                            </td>
                            <td>{{$job->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="btn-group direction">
                                    <a href="{{route('getEditJob',['id'=>$job->id])}}"
                                       class="btn btn-info p-2 pr-3 pl-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteJob('{{$job->id}}')" class="btn btn-danger p-2 pr-3 pl-3">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--<div class="text-center col-md-12  m-auto">--}}
        {{--<div id='map'></div>--}}
        {{--</div>--}}
    </div>
</div>