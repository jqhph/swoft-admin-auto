<div {!! $attributes !!}>
    @if ($title || $tools)
        <div class="card-header with-border {{$style}}">
            <span class="card-box-title">{!! $title !!}</span>
            <div class="box-tools pull-right">
                @foreach($tools as $tool)
                    {!! $tool !!}
                @endforeach
            </div>
            <div style="clear:both;height:0"></div>
        </div>
    @endif
    <div class="card-body card-padding panel-collapse collapse" style="display:block;">
        {!! $content !!}
    </div>
</div>