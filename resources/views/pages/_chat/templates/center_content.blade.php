<div id="content" class="section direction">
    <div class="container-fluid">
        <div class="button-container">
            <button class="btn btn-main-bordered btn-round btn-lg" id="comp_msg" data-toggle="modal" data-target="#all-users-modal-lg">
                <span>
                    Compose Message
                </span>
            </button>
            <a href="#" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="تابعنا هنا">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="تابعنا هنا">
                <i class="fab fa-instagram"></i>
            </a>
        </div>


        <div class="row mt-3">
            <div class="col-md-3 text-left">
                @include("pages.chat.templates.right_side")
            </div>
            <div class="col-md-12 text-center mt-4">
                @include("pages.chat.templates.center_side")
            </div>
        </div>

    </div>

</div>