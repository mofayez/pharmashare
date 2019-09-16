<div class="modal fade" id="all-users-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-center">
                {{Form::open([
                    'route'=>'chatPostSendMessage',
                    'method'=>'post',
                    'id'=>'compose_message'
                ])}}
                <div class="row direction">
                    <input type="hidden" name="from_user_id" value="{{$user->id}}">
                    <div class="col-md-5 text-left">
                        <select name="to_user_id" class="selectpicker form-control"  data-live-search="true" 
                                    data-size="7"  data-style="btn-main" >
                            @foreach($all_users as $_user)
                                @if($user->id != $_user->id)
                                <option value="{{$_user->id}}">
                                    {{$_user->firstname . " " . $_user->lastname}} | {{'@'.$_user->username}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control bg-transparent"  name="message" placeholder="Write Your Message" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-main">
                        <i class="now-ui-icons ui-1_send"></i> Send Message
                    </button>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>