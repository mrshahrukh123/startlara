@can($edit_permission)
    <a data-toggle="tooltip" data-placement="top" title="{{ 'Edit '.$tool_tip_title }}" href="{{$edit_route}}">
        <i class="fas fa-pencil-alt"></i>
    </a>
@endcan
@if(!empty($options_route))
    <a data-toggle="tooltip" data-placement="top" title="{{ $tool_tip_title_child }}" href="{{$options_route}}">
        <i class="fas fa-list-ul"></i>
    </a>
@endif
@can($delete_permission)
<a class="confirm_delete" data-toggle="tooltip" data-placement="top" title="{{ 'Delete '.$tool_tip_title }}" data-id="{{$id}}" href="{{$delete_route}}">
	<i class="fas fa-trash"></i>
</a>
{!! Form::open(['method'=>'DELETE','action'=>$delete_action, 'id'=>'delete_form_'.$id, 'style'=>'display:none']) !!}
{!!Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
@endcan
