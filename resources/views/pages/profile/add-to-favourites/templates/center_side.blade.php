<div class="row" style="margin-top: -140px;z-index: 9;">
    <div style="position: fixed;z-index: 9;right: 40px;bottom: 40px;">
        <a href="{{route('getShowFavouritesView')}}" class="btn btn-main" id="list_btn">
            {{app()->getLocale() == 'ar' ? 'قائمتي' : 'My List'}}
            (<span id="favourites-count">{{count($favourites) ?? 0}}</span>)
        </a>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('getAddProductView')}}">
                            {{__('store.add_one_product')}}
                            <i class="now-ui-icons shopping_bag-16"></i>
                        </a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="{{route('getAddProductView')}}">-->
                    <!--        {{__('store.upload_csv_sheet')}}-->
                    <!--        <i class="now-ui-icons arrows-1_cloud-upload-94"></i>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="nav-item ">
                        <a class="nav-link active show" href="{{route('getAddToFavouritesView')}}">
                            {{__('store.name_first')}}
                            <i class="now-ui-icons ui-2_favourite-28"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-right">
                            <label> {{__('pharmacy.origin')}} </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="5"
                                   checked/>
                        </div>
                        <div class="text-right">
                            <label> {{__('pharmacy.product_category')}} </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="4"
                                   checked/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control text-center bg-white typeahead" name="drug_name"
                               autocomplete="off"
                               placeholder="{{__('pharmacy.search_place')}} by (Name , Pharma Code , Active Ingredient , Manufacturer)"/>
                        <div class="mb-2"></div>
                    </div>
                    <div class="col-md-4"> 
                        <div class="text-left">
                            <input type="checkbox" class="bootstrap-switch" data-column="2"
                                   checked/>
                            <label> {{__('pharmacy.manufacturer')}} </label>
                        </div>
                        <div class="text-left">
                            <input type="checkbox" class="bootstrap-switch" data-column="3"
                                   checked/>
                            <label> {{__('pharmacy.packet_size')}} </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h4 class="m-0">{{app()->getLocale() == 'ar' ? 'اجمالى عدد الادوية' : 'All Drugs Count'}} : <span class="text-danger">{{$drugs_count}}</span> </h4>
                        
                        <br/>
                    </div>
                    <div class="col-md-6 text-right">
                            <label> {{app()->getLocale() == 'ar' ? '  اضافة اكثر من منتج للمفضلة  ' : 'Bulk add to store'}}</label> 
                            <input type="checkbox" class="bootstrap-switch" name="bulk" value='1'/>
                    </div>
                </div>
                <div class="col-md-12" style="overflow:scroll">
                <table class="table table-bordered" id="myTable">
                    <thead>
                    <tr class="text-left">
                        <th></th>
                        <th>{{__('pharmacy.bar_code')}}</th>
                        <th width="35%">{{__('pharmacy.product_name')}}</th>
                        <th>{{__('pharmacy.manufacturer')}}</th>
                        <th>{{__('pharmacy.packet_size')}}</th>
                        <th>{{__('pharmacy.product_category')}}</th>
                        <th>{{__('pharmacy.origin')}}</th>
                        <th>{{__('pharmacy.strength')}}</th>
                    </tr>
                    </thead>
                    <tbody> 
                        @foreach($drugs as $drug)
                        <tr>
                            <td>
                                <button class="btn btn-warning add-to-fav p-2 pl-3 pr-3" @if(in_array($drug->id , $favourites->toArray())) disabled @endif  data-item-id="{{$drug->id}}" data-item-pack_size="{{$drug->pack_size}}" data-item-strength="{{$drug->strength}}" data-item-active_ingredient="{{$drug->active_ingredient}}" data-item-trade_name="{{$drug->trade_name}}" data-item-pharmashare_code="{{$drug->pharmashare_code}}" data-item-manufacturer="{{$drug->manufacturer}}" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">
                                   {{app()->getLocale() == 'ar' ? 'اضافة للمخزن' : 'Add To Store'}} 
                                </button>
                            </td>
                            <td>{{$drug->pharmashare_code }}</td>
                            <td>
                                <h6 class="m-0 p-0" style="text-align: left">
                                    {{$drug->trade_name }}
                                </h6>
                            </td>
                            <td>{{$drug->manufacturer }}</td>
                            <td>{{$drug->pack_size }}</td>
                            <td>{{$drug->form }}</td>
                            <td>{{$drug->active_ingredient }}</td>
                            <td>{{$drug->strength }}</td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>