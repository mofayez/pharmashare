@if(!$current_user->location)
    <div class="row">
        <div class="col-md-12 text-center">
            <h4>{{app()->getLocale() == 'ar' ? 'ﻻ يوجد خريطة': 'No Marker To Set'}}</h4>
        </div>
    </div>
@else

    <div class="row">
        <div class="col-md-12 text-center">
            <div id='map'></div>
        </div>
    </div>
@endif