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
<div class="card">
    <div class="card card-blog card-plain card-body"> 
        <div class="row">  
            <div class="col-md-12 d-none d-md-block">
                <form>
                     <input type="text" class="form-control text-center bg-white typeahead" name="q"
                                   autocomplete="off"
                                   value="{{request()->q}}"
                                   placeholder="{{__('pharmacy.search_place')}}"/>
                        <div class="mb-2"></div>
                </form>
            </div>
            <div class="col-md-12 d-none d-md-block">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>{{__('jobs.job_title')}} </th>
                            <th>{{__('jobs.salary')}} </th>
                            <th>{{__('jobs.created_at')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($jobs) == 0)
                        <tr>
                            <td colspan="4">{{app()->getLocale() == 'ar' ? 'لا توجد بيانات': 'No Jobs'}}
                        </tr>
                        @endif
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{$job->job_name}}</td>
                            <td>
                                {{$job->salary}} - {{$job->max_salary}}
                            </td>
                            <td>{{$job->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="btn-group direction"> 
                                    <button class="btn btn-main p-2 pr-3 pl-3" data-info="{{$job}}" data-target="#jobs_modal" data-toggle="modal">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div> 
    </div>
</div>