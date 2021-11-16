<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{$heading}}
            </h3>
        </div>
    </div>
    @if(isset($url) && isset($title))
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{$url}}" class="btn m-btn--pill btn-primary">
                        @if(!isset($icon))
                            <span><i class="la la-plus"></i></span>
                        @endif
                        {{$title}}
                    </a>
                </li>
            </ul>
        </div>
    @endif
</div>
