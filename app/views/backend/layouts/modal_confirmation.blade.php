<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_delete_confirm_title">@lang('admin/'.$model.'/modal.title')</h4>
</div>
<div class="modal-body">
    @if($error)
        <div>{{{ $error }}}</div>
    @else
        @lang('admin/'.$model.'/modal.body')
    @endif
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin/'.$model.'/modal.cancel')</button>
  @if(!$error)
    <a href="{{ $confirm_route }}" type="button" class="btn btn-primary">@lang('admin/'.$model.'/modal.confirm')</a>
  @endif
</div>
