
@if (in_array("show", $actions))
    <a class="" title="@lang('rapyd::rapyd.show')" href="{!! $uri !!}/{!! $id !!}"><span class="glyphicon glyphicon-eye-open"> </span></a>
@endif

@if (in_array("edit", $actions))
    <a class="" title="@lang('rapyd::rapyd.modify')" href="{!! $uri !!}/{!! $id !!}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
@endif

@if (in_array("destroy", $actions))
    <a class="text-danger" title="@lang('rapyd::rapyd.delete')" href="#" onclick="$(this).next('form').submit()"><span class="glyphicon glyphicon-trash"> </span></a>
    {!! Form::open(['url' => "$uri/$id", 'method' => 'DELETE']) !!}
    {!! Form::close() !!}
@endif
