<style>
    .my-group input {
        height: 40px !important;
        max-width: 45% !important;
    }

    .my-group .btn-main {
        height: 40px !important;
        max-width: 10% !important;
    }

    .datepicker {
        z-index: 999 !important;
        padding: 8px 6px;
        border-radius: 4px;
        direction: ltr;
        transform: translate3d(0, -40px, 0);
        transition: all .3s cubic-bezier(.215, .61, .355, 1) 0s, opacity .3s ease 0s, height 0s linear .35s;
        opacity: 0;
        filter: alpha(opacity=0);
        visibility: hidden;
        display: block;
        width: 254px;
        max-width: 254px
    }

    .datepicker.dropdown-menu:before {
        display: none
    }

    .datepicker.datepicker-primary {
        background-color: #742cc2
    }

    .datepicker.datepicker-primary .day div, .datepicker.datepicker-primary table tr td span, .datepicker.datepicker-primary th {
        color: #fff
    }

    .datepicker.datepicker-primary:after {
        border-bottom-color: #742cc2
    }

    .datepicker.datepicker-primary.datepicker-orient-top:after {
        border-top-color: #742cc2
    }

    .datepicker.datepicker-primary .dow {
        color: hsla(0, 0%, 100%, .8)
    }

    .datepicker.datepicker-primary table tr td.new div, .datepicker.datepicker-primary table tr td.old div, .datepicker.datepicker-primary table tr td span.new, .datepicker.datepicker-primary table tr td span.old {
        color: hsla(0, 0%, 100%, .4)
    }

    .datepicker.datepicker-primary table tr td span.focused, .datepicker.datepicker-primary table tr td span:hover {
        background: hsla(0, 0%, 100%, .1)
    }

    .datepicker.datepicker-primary .datepicker-switch:hover, .datepicker.datepicker-primary .next:hover, .datepicker.datepicker-primary .prev:hover, .datepicker.datepicker-primary tfoot tr th:hover {
        background: hsla(0, 0%, 100%, .2)
    }

    .datepicker.datepicker-primary table tr td.active.disabled:hover div, .datepicker.datepicker-primary table tr td.active.disabled div, .datepicker.datepicker-primary table tr td.active:hover div, .datepicker.datepicker-primary table tr td.active div {
        background-color: #fff;
        color: #742cc2
    }

    .datepicker.datepicker-primary table tr td.day.focused div, .datepicker.datepicker-primary table tr td.day:hover div {
        background: hsla(0, 0%, 100%, .2)
    }

    .datepicker.datepicker-primary table tr td.active.active div, .datepicker.datepicker-primary table tr td.active.disabled.active div, .datepicker.datepicker-primary table tr td.active.disabled.disabled div, .datepicker.datepicker-primary table tr td.active.disabled:active div, .datepicker.datepicker-primary table tr td.active.disabled:hover.active div, .datepicker.datepicker-primary table tr td.active.disabled:hover.disabled div, .datepicker.datepicker-primary table tr td.active.disabled:hover:active div, .datepicker.datepicker-primary table tr td.active.disabled:hover:hover div, .datepicker.datepicker-primary table tr td.active.disabled:hover[disabled] div, .datepicker.datepicker-primary table tr td.active.disabled:hover div, .datepicker.datepicker-primary table tr td.active.disabled[disabled] div, .datepicker.datepicker-primary table tr td.active.disabled div, .datepicker.datepicker-primary table tr td.active:active div, .datepicker.datepicker-primary table tr td.active:hover.active div, .datepicker.datepicker-primary table tr td.active:hover.disabled div, .datepicker.datepicker-primary table tr td.active:hover:active div, .datepicker.datepicker-primary table tr td.active:hover:hover div, .datepicker.datepicker-primary table tr td.active:hover[disabled] div, .datepicker.datepicker-primary table tr td.active:hover div, .datepicker.datepicker-primary table tr td.active[disabled] div, .datepicker.datepicker-primary table tr td span.active.active, .datepicker.datepicker-primary table tr td span.active.disabled, .datepicker.datepicker-primary table tr td span.active.disabled.active, .datepicker.datepicker-primary table tr td span.active.disabled.disabled, .datepicker.datepicker-primary table tr td span.active.disabled:active, .datepicker.datepicker-primary table tr td span.active.disabled:hover, .datepicker.datepicker-primary table tr td span.active.disabled:hover.active, .datepicker.datepicker-primary table tr td span.active.disabled:hover.disabled, .datepicker.datepicker-primary table tr td span.active.disabled:hover:active, .datepicker.datepicker-primary table tr td span.active.disabled:hover:hover, .datepicker.datepicker-primary table tr td span.active.disabled:hover[disabled], .datepicker.datepicker-primary table tr td span.active.disabled[disabled], .datepicker.datepicker-primary table tr td span.active:active, .datepicker.datepicker-primary table tr td span.active:hover, .datepicker.datepicker-primary table tr td span.active:hover.active, .datepicker.datepicker-primary table tr td span.active:hover.disabled, .datepicker.datepicker-primary table tr td span.active:hover:active, .datepicker.datepicker-primary table tr td span.active:hover:hover, .datepicker.datepicker-primary table tr td span.active:hover[disabled], .datepicker.datepicker-primary table tr td span.active[disabled] {
        background-color: #fff
    }

    .datepicker.datepicker-primary table tr td span.active.active, .datepicker.datepicker-primary table tr td span.active.disabled, .datepicker.datepicker-primary table tr td span.active.disabled.active, .datepicker.datepicker-primary table tr td span.active.disabled.disabled, .datepicker.datepicker-primary table tr td span.active.disabled:active, .datepicker.datepicker-primary table tr td span.active.disabled:hover, .datepicker.datepicker-primary table tr td span.active.disabled:hover.active, .datepicker.datepicker-primary table tr td span.active.disabled:hover.disabled, .datepicker.datepicker-primary table tr td span.active.disabled:hover:active, .datepicker.datepicker-primary table tr td span.active.disabled:hover:hover, .datepicker.datepicker-primary table tr td span.active.disabled:hover[disabled], .datepicker.datepicker-primary table tr td span.active.disabled[disabled], .datepicker.datepicker-primary table tr td span.active:active, .datepicker.datepicker-primary table tr td span.active:hover, .datepicker.datepicker-primary table tr td span.active:hover.active, .datepicker.datepicker-primary table tr td span.active:hover.disabled, .datepicker.datepicker-primary table tr td span.active:hover:active, .datepicker.datepicker-primary table tr td span.active:hover:hover, .datepicker.datepicker-primary table tr td span.active:hover[disabled], .datepicker.datepicker-primary table tr td span.active[disabled] {
        color: #742cc2
    }

    .datepicker-inline {
        width: 220px
    }

    .datepicker.datepicker-rtl {
        direction: rtl
    }

    .datepicker.datepicker-rtl.dropdown-menu {
        left: auto
    }

    .datepicker.datepicker-rtl table tr td span {
        float: right
    }

    .datepicker-dropdown {
        top: 0;
        left: 0
    }

    .datepicker-dropdown:before {
        content: "";
        display: inline-block;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-bottom: 7px solid transparent;
        border-top: 0;
        border-bottom-color: rgba(0, 0, 0, .2);
        position: absolute
    }

    .datepicker-dropdown:after {
        content: "";
        display: inline-block;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #fff;
        border-top: 0;
        position: absolute
    }

    .datepicker-dropdown.datepicker-orient-left:before {
        left: 6px
    }

    .datepicker-dropdown.datepicker-orient-left:after {
        left: 7px
    }

    .datepicker-dropdown.datepicker-orient-right:before {
        right: 6px
    }

    .datepicker-dropdown.datepicker-orient-right:after {
        right: 7px
    }

    .datepicker-dropdown.datepicker-orient-bottom:before {
        top: -7px
    }

    .datepicker-dropdown.datepicker-orient-bottom:after {
        top: -6px
    }

    .datepicker-dropdown.datepicker-orient-top:before {
        bottom: -7px;
        border-bottom: 0;
        border-top: 7px solid transparent
    }

    .datepicker-dropdown.datepicker-orient-top:after {
        bottom: -6px;
        border-bottom: 0;
        border-top: 6px solid #fff
    }

    .datepicker table {
        margin: 0;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        width: 241px;
        max-width: 241px
    }

    .datepicker .day div, .datepicker th {
        transition: all .3s ease 0s;
        text-align: center;
        width: 30px;
        height: 30px;
        line-height: 2.2;
        border-radius: 50%;
        font-weight: 300;
        font-size: 14px;
        border: none;
        z-index: 1;
        position: relative;
        cursor: pointer
    }

    .datepicker th {
        color: #742cc2
    }

    .table-condensed > tbody > tr > td, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > td, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > thead > tr > th {
        padding: 2px;
        text-align: center;
        cursor: pointer
    }

    .table-striped .datepicker table tr td, .table-striped .datepicker table tr th {
        background-color: transparent
    }

    .datepicker table tr td.day.focused div, .datepicker table tr td.day:hover div {
        background: #eee;
        cursor: pointer
    }

    .datepicker table tr td.new, .datepicker table tr td.old {
        color: #888
    }

    .datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
        background: none;
        color: #888;
        cursor: default
    }

    .datepicker table tr td.highlighted {
        background: #d9edf7;
        border-radius: 0
    }

    .datepicker table tr td.today, .datepicker table tr td.today.disabled, .datepicker table tr td.today.disabled:hover, .datepicker table tr td.today:hover {
        background-color: #fde19a;
        background-image: linear-gradient(180deg, #fdd49a, #fdf59a);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#fdd49a", endColorstr="#fdf59a", GradientType=0);
        border-color: #fdf59a #fdf59a #fbed50;
        border-color: rgba(0, 0, 0, .1) rgba(0, 0, 0, .1) rgba(0, 0, 0, .25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        color: #000
    }

    .datepicker table tr td.today.active, .datepicker table tr td.today.disabled, .datepicker table tr td.today.disabled.active, .datepicker table tr td.today.disabled.disabled, .datepicker table tr td.today.disabled:active, .datepicker table tr td.today.disabled:hover, .datepicker table tr td.today.disabled:hover.active, .datepicker table tr td.today.disabled:hover.disabled, .datepicker table tr td.today.disabled:hover:active, .datepicker table tr td.today.disabled:hover:hover, .datepicker table tr td.today.disabled:hover[disabled], .datepicker table tr td.today.disabled[disabled], .datepicker table tr td.today:active, .datepicker table tr td.today:hover, .datepicker table tr td.today:hover.active, .datepicker table tr td.today:hover.disabled, .datepicker table tr td.today:hover:active, .datepicker table tr td.today:hover:hover, .datepicker table tr td.today:hover[disabled], .datepicker table tr td.today[disabled] {
        background-color: #fdf59a
    }

    .datepicker table tr td.today.active, .datepicker table tr td.today.disabled.active, .datepicker table tr td.today.disabled:active, .datepicker table tr td.today.disabled:hover.active, .datepicker table tr td.today.disabled:hover:active, .datepicker table tr td.today:active, .datepicker table tr td.today:hover.active, .datepicker table tr td.today:hover:active {
        background-color: #fbf069 \9
    }

    .datepicker table tr td.today:hover:hover {
        color: #000
    }

    .datepicker table tr td.today.active:hover {
        color: #fff
    }

    .datepicker table tr td.range, .datepicker table tr td.range.disabled, .datepicker table tr td.range.disabled:hover, .datepicker table tr td.range:hover {
        background: #eee;
        border-radius: 0
    }

    .datepicker table tr td.range.today, .datepicker table tr td.range.today.disabled, .datepicker table tr td.range.today.disabled:hover, .datepicker table tr td.range.today:hover {
        background-color: #f3d17a;
        background-image: linear-gradient(180deg, #f3c17a, #f3e97a);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#f3c17a", endColorstr="#f3e97a", GradientType=0);
        border-color: #f3e97a #f3e97a #edde34;
        border-color: rgba(0, 0, 0, .1) rgba(0, 0, 0, .1) rgba(0, 0, 0, .25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        border-radius: 0
    }

    .datepicker table tr td.range.today.active, .datepicker table tr td.range.today.disabled, .datepicker table tr td.range.today.disabled.active, .datepicker table tr td.range.today.disabled.disabled, .datepicker table tr td.range.today.disabled:active, .datepicker table tr td.range.today.disabled:hover, .datepicker table tr td.range.today.disabled:hover.active, .datepicker table tr td.range.today.disabled:hover.disabled, .datepicker table tr td.range.today.disabled:hover:active, .datepicker table tr td.range.today.disabled:hover:hover, .datepicker table tr td.range.today.disabled:hover[disabled], .datepicker table tr td.range.today.disabled[disabled], .datepicker table tr td.range.today:active, .datepicker table tr td.range.today:hover, .datepicker table tr td.range.today:hover.active, .datepicker table tr td.range.today:hover.disabled, .datepicker table tr td.range.today:hover:active, .datepicker table tr td.range.today:hover:hover, .datepicker table tr td.range.today:hover[disabled], .datepicker table tr td.range.today[disabled] {
        background-color: #f3e97a
    }

    .datepicker table tr td.range.today.active, .datepicker table tr td.range.today.disabled.active, .datepicker table tr td.range.today.disabled:active, .datepicker table tr td.range.today.disabled:hover.active, .datepicker table tr td.range.today.disabled:hover:active, .datepicker table tr td.range.today:active, .datepicker table tr td.range.today:hover.active, .datepicker table tr td.range.today:hover:active {
        background-color: #efe24b \9
    }

    .datepicker table tr td.selected, .datepicker table tr td.selected.disabled, .datepicker table tr td.selected.disabled:hover, .datepicker table tr td.selected:hover {
        background-color: #9e9e9e;
        background-image: linear-gradient(180deg, #b3b3b3, gray);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#b3b3b3", endColorstr="#808080", GradientType=0);
        border-color: gray gray #595959;
        border-color: rgba(0, 0, 0, .1) rgba(0, 0, 0, .1) rgba(0, 0, 0, .25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        color: #fff;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, .25)
    }

    .datepicker table tr td.selected.active, .datepicker table tr td.selected.disabled, .datepicker table tr td.selected.disabled.active, .datepicker table tr td.selected.disabled.disabled, .datepicker table tr td.selected.disabled:active, .datepicker table tr td.selected.disabled:hover, .datepicker table tr td.selected.disabled:hover.active, .datepicker table tr td.selected.disabled:hover.disabled, .datepicker table tr td.selected.disabled:hover:active, .datepicker table tr td.selected.disabled:hover:hover, .datepicker table tr td.selected.disabled:hover[disabled], .datepicker table tr td.selected.disabled[disabled], .datepicker table tr td.selected:active, .datepicker table tr td.selected:hover, .datepicker table tr td.selected:hover.active, .datepicker table tr td.selected:hover.disabled, .datepicker table tr td.selected:hover:active, .datepicker table tr td.selected:hover:hover, .datepicker table tr td.selected:hover[disabled], .datepicker table tr td.selected[disabled] {
        background-color: gray
    }

    .datepicker table tr td.selected.active, .datepicker table tr td.selected.disabled.active, .datepicker table tr td.selected.disabled:active, .datepicker table tr td.selected.disabled:hover.active, .datepicker table tr td.selected.disabled:hover:active, .datepicker table tr td.selected:active, .datepicker table tr td.selected:hover.active, .datepicker table tr td.selected:hover:active {
        background-color: #666 \9
    }

    .datepicker table tr td.active.disabled:hover div, .datepicker table tr td.active.disabled div, .datepicker table tr td.active:hover div, .datepicker table tr td.active div {
        background-color: #742cc2;
        color: #fff;
        box-shadow: 0 1px 10px 0 rgba(0, 0, 0, .2)
    }

    .datepicker table tr td.active.active div, .datepicker table tr td.active.disabled.active div, .datepicker table tr td.active.disabled.disabled div, .datepicker table tr td.active.disabled:active div, .datepicker table tr td.active.disabled:hover.active div, .datepicker table tr td.active.disabled:hover.disabled div, .datepicker table tr td.active.disabled:hover:active div, .datepicker table tr td.active.disabled:hover:hover div, .datepicker table tr td.active.disabled:hover[disabled] div, .datepicker table tr td.active.disabled:hover div, .datepicker table tr td.active.disabled[disabled] div, .datepicker table tr td.active.disabled div, .datepicker table tr td.active:active div, .datepicker table tr td.active:hover.active div, .datepicker table tr td.active:hover.disabled div, .datepicker table tr td.active:hover:active div, .datepicker table tr td.active:hover:hover div, .datepicker table tr td.active:hover[disabled] div, .datepicker table tr td.active:hover div, .datepicker table tr td.active[disabled] div {
        background-color: #742cc2
    }

    .datepicker table tr td.active.active, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover.active, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active:active, .datepicker table tr td.active:hover.active, .datepicker table tr td.active:hover:active {
        background-color: #039 \9
    }

    .datepicker table tr td span {
        display: block;
        width: 41px;
        height: 41px;
        line-height: 41px;
        float: left;
        margin: 1%;
        font-size: 14px;
        cursor: pointer;
        border-radius: 50%
    }

    .datepicker table tr td span.focused, .datepicker table tr td span:hover {
        background: #eee
    }

    .datepicker table tr td span.disabled, .datepicker table tr td span.disabled:hover {
        background: none;
        color: #888;
        cursor: default
    }

    .datepicker table tr td span.active, .datepicker table tr td span.active.disabled, .datepicker table tr td span.active.disabled:hover, .datepicker table tr td span.active:hover {
        color: #fff;
        background-color: #742cc2
    }

    .datepicker table tr td span.active.active, .datepicker table tr td span.active.disabled, .datepicker table tr td span.active.disabled.active, .datepicker table tr td span.active.disabled.disabled, .datepicker table tr td span.active.disabled:active, .datepicker table tr td span.active.disabled:hover, .datepicker table tr td span.active.disabled:hover.active, .datepicker table tr td span.active.disabled:hover.disabled, .datepicker table tr td span.active.disabled:hover:active, .datepicker table tr td span.active.disabled:hover:hover, .datepicker table tr td span.active.disabled:hover[disabled], .datepicker table tr td span.active.disabled[disabled], .datepicker table tr td span.active:active, .datepicker table tr td span.active:hover, .datepicker table tr td span.active:hover.active, .datepicker table tr td span.active:hover.disabled, .datepicker table tr td span.active:hover:active, .datepicker table tr td span.active:hover:hover, .datepicker table tr td span.active:hover[disabled], .datepicker table tr td span.active[disabled] {
        background-color: #742cc2;
        box-shadow: 0 1px 10px 0 rgba(0, 0, 0, .2)
    }

    .datepicker table tr td span.active.active, .datepicker table tr td span.active.disabled.active, .datepicker table tr td span.active.disabled:active, .datepicker table tr td span.active.disabled:hover.active, .datepicker table tr td span.active.disabled:hover:active, .datepicker table tr td span.active:active, .datepicker table tr td span.active:hover.active, .datepicker table tr td span.active:hover:active {
        background-color: #039 \9
    }

    .datepicker table tr td span.new, .datepicker table tr td span.old {
        color: #888
    }

    .datepicker .datepicker-switch {
        width: auto;
        border-radius: .1875rem
    }

    .datepicker .datepicker-switch, .datepicker .next, .datepicker .prev, .datepicker tfoot tr th {
        cursor: pointer
    }

    .datepicker .next, .datepicker .prev {
        width: 35px;
        height: 35px
    }

    .datepicker i {
        position: relative;
        top: 2px
    }

    .datepicker .prev i {
        left: -1px
    }

    .datepicker .next i {
        right: -1px
    }

    .datepicker .datepicker-switch:hover, .datepicker .next:hover, .datepicker .prev:hover, .datepicker tfoot tr th:hover {
        background: #eee
    }

    .datepicker .next.disabled, .datepicker .prev.disabled {
        visibility: hidden
    }

    .datepicker .cw {
        font-size: 10px;
        width: 12px;
        padding: 0 2px 0 5px;
        vertical-align: middle
    }

    .input-append.date .add-on, .input-prepend.date .add-on {
        cursor: pointer
    }

    .input-append.date .add-on i, .input-prepend.date .add-on i {
        margin-top: 3px
    }

    .input-daterange input {
        text-align: center
    }

    .input-daterange input:first-child {
        border-radius: 3px 0 0 3px
    }

    .input-daterange input:last-child {
        border-radius: 0 3px 3px 0
    }

    .input-daterange
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card direction">
            <div class="card-header">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="false">
                            {{__('store.edit_product')}}
                            <i class="now-ui-icons shopping_bag-16"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content text-center">
                    <div class="tab-pane active show" id="home" role="tabpanel">

                        {{Form::open([
                            'id'=>'form',
                            'method'=>'post',
                            'route'=>['postEditDrugStore',$drug_store->id],
                        ])}}

                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-left m-0 text_purple_gradient">
                                    {{__('store.main_info')}}
                                </h3>
                                <hr class="mt-0">
                            </div>
                            <div class="col-md-4 text-left">
                                <div class="form-group">
                                    <label>{{__('store.bar_code')}} </label>
                                    <input type="text" class="form-control"
                                           value="{{$drug_store->drug->pharmashare_code}}" name="pharmashare_code"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label> {{__('store.product_category')}}   </label>
                                    <input type="text" class="form-control"
                                           value="{{$drug_store->drug->drugCategory->title}}"
                                           name="form" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 text-left">
                                <div class="form-group">
                                    <label> {{__('store.product_name')}}   </label>
                                    <input type="text" class="form-control" value="{{$drug_store->drug->trade_name}}"
                                           name="trade_name" disabled>
                                </div>
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label>{{__('store.packet_size')}}</label>
                                    <input type="text" class="form-control" value="{{$drug_store->drug->pack_size}}"
                                           name="pack_size" disabled>
                                </div>
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label>{{__('store.origin')}}   </label>
                                    <input type="text" class="form-control"
                                           value="{{$drug_store->drug->active_ingredient}}" name="active_ingredient"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label>{{__('store.strength')}} </label>
                                    <input type="text" class="form-control" value="{{$drug_store->drug->strength}}"
                                           name="strength" disabled>
                                </div>
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label>{{__('store.manufacturer')}} </label>
                                    <input type="text" class="form-control" value="{{$drug_store->drug->manufacturer}}"
                                           name="manufacturer" disabled>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label>{{__('store.amount')}} </label>
                                    <input type="text" class="form-control" name="available_quantity_in_packs"
                                           value="{{$drug_store->available_quantity_in_packs}}">
                                </div>
                                @if($errors->has('available_quantity_in_packs'))
                                    <span class="text-danger">
                                        {{$errors->first('available_quantity_in_packs')}}
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label>{{__('store.cost')}} </label>
                                    <input type="text" class="form-control" name="offered_price_or_bonus"
                                           value="{{$drug_store->offered_price_or_bonus}}">
                                </div>
                                @if($errors->has('offered_price_or_bonus'))
                                    <span class="text-danger">
                                        {{$errors->first('offered_price_or_bonus')}}
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label>  {{__('store.min_amount')}}   </label>
                                    <input type="text" class="form-control" name="minimum_order_value_or_quantity"
                                           value="{{$drug_store->minimum_order_value_or_quantity}}">
                                </div>
                                @if($errors->has('minimum_order_value_or_quantity'))
                                    <span class="text-danger">
                                        {{$errors->first('minimum_order_value_or_quantity')}}
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 text-left">
                                <div class="form-group">
                                    <label>{{__('store.notes')}} </label>
                                    <input type="text" class="form-control" name="store_remarks"
                                           value="{{$drug_store->store_remarks}}">
                                </div>
                                @if($errors->has('store_remarks'))
                                    <span class="text-danger">
                                        {{$errors->first('store_remarks')}}
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <h3 class="text-left m-0 text_purple_gradient">{{__('store.discount_info')}}</h3>
                                <div class="table-scroll">
                                    <table class="table" id="discount_table">
                                        <thead>
                                        <tr>
                                            <td width="10px">
                                                <button type="button" id="add_button" class="btn btn-info">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </td>
                                            <td>{{__('store.amount_request')}}</td>
                                            <td>{{__('store.discount_calc')}}</td>
                                            <td>{{__('store.points')}}</td>
                                            <td>{{__('store.active')}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($drug_store->FOC as $k => $foc)
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn btn-danger removerow">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <input name="foc_quantity[{{$k}}]" class="form-control text-center"
                                                           type="number" value="{{$foc->foc_quantity}}">
                                                </td>
                                                <td>
                                                    <input name="foc_discount[{{$k}}]" class="form-control text-center"
                                                           type="number" value="{{$foc->foc_discount}}">
                                                </td>
                                                <td>
                                                    <input name="reward_points[{{$k}}]" class="form-control text-center"
                                                           type="number" value="{{$foc->reward_points}}">
                                                </td>
                                                <td>
                                                    <select name="is_activated[{{$k}}]"
                                                            class="form-control text-center">
                                                        <option @if($foc->is_activated) selected @endif value="1">Yes</option>
                                                        <option  @if(!$foc->is_activated) selected @endif  value="0">No</option>
                                                    </select>
                                                </td>


                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="text-center col-md-12  m-auto">
                                <button class="btn btn-main">
                                    {{__('store.update')}}
                                </button>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <input type="file" name="files">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>