@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/posts/title.create') ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
    <h3>
        @lang('admin/posts/title.create')

        <div class="pull-right">
            <a href="{{ route('posts') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
        </div>
    </h3>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab">@lang('admin/posts/form.general')</a></li>
    <li><a href="#tab-meta-data" data-toggle="tab">@lang('admin/posts/form.metadata')</a></li>
</ul>

<form class="form-horizontal" role="form" method="post" action="">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
        <br>

            <!-- Post Title -->
            <div class="form-group {{ $errors->first('title', 'has-error') }}">
                <label for="title" class="col-sm-2 control-label">@lang('admin/posts/form.posttitle')</label>
                    <div class="col-sm-5">
                        <input type="text" id="title" name="title" class="form-control" placeholder="Partner title" value="{{{ Input::old('title') }}}">
                    </div>
                    <div class="col-sm-4">
                    {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Post Slug -->
            <div class="form-group {{ $errors->first('slug', 'has-error') }}">
                <label for="title" class="col-sm-2 control-label">@lang('admin/posts/form.slug')</label>
                    <div class="col-sm-3">
                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Partner slug" value="{{{ Input::old('slug') }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('slug', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Partner website -->
            <div class="form-group {{ $errors->first('partnerwebsite', 'has-error') }}">
                <label for="partnerwebsite" class="col-sm-2 control-label">@lang('admin/posts/form.partnerwebsite')</label>
                    <div class="col-sm-5">
                        <input type="text" id="partnerwebsite" name="partnerwebsite" class="form-control" placeholder="http://partner-website" value="{{{ Input::old('title') }}}">
                    </div>
                    <div class="col-sm-4">
                    {{ $errors->first('partnerwebsite', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- status -->
            <div class="form-group {{ $errors->first('status', 'has-error') }}">
                <label for="status" class="col-sm-2 control-label">@lang('admin/posts/form.status')</label>
                    <div class="col-sm-5">
                        <select name="status" id="status">
                        <option value="2"{{ (Input::old('status', 0) === 2 ? ' selected="selected"' : '') }}>@lang('admin/posts/statuses.new')</option>
                        <option value="1"{{ (Input::old('status', 0) === 1 ? ' selected="selected"' : '') }}>@lang('admin/posts/statuses.available')</option>
                        <option value="0"{{ (Input::old('status', 0) === 0 ? ' selected="selected"' : '') }}>@lang('admin/posts/statuses.coming')</option>
                    </select>
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('status', '<span class="help-block">:message</span>') }}
                    </div>
            </div>                      

            <!-- Content / years -->
            <div class="form-group {{ $errors->first('yearsavailable', 'has-error') }}">
                <label for="yearsavailable" class="col-sm-2 control-label">@lang('admin/posts/form.yearsavailable')</label>
                <div class="col-sm-10">
                {{ $errors->first('yearsavailable', '<span class="help-block">:message</span>') }}
                    <textarea rows="4" id="yearsavailable" name="yearsavailable" class="form-control">{{{ Input::old('yearsavailable') }}}</textarea>
                </div>
            </div>
            <!-- Content / cleaning -->
            <div class="form-group {{ $errors->first('notescleaning', 'has-error') }}">
                <label for="notescleaning" class="col-sm-2 control-label">@lang('admin/posts/form.notescleaning')</label>
                <div class="col-sm-10">
                {{ $errors->first('notescleaning', '<span class="help-block">:message</span>') }}
                    <textarea rows="4" id="notescleaning" name="notescleaning" class="form-control">{{{ Input::old('notescleaning') }}}</textarea>
                </div>
            </div>
            <!-- Content / notes -->
            <div class="form-group {{ $errors->first('notessource', 'has-error') }}">
                <label for="notessource" class="col-sm-2 control-label">@lang('admin/posts/form.notessource')</label>
                <div class="col-sm-10">
                {{ $errors->first('notessource', '<span class="help-block">:message</span>') }}
                    <textarea rows="4" id="notessource" name="notessource" class="form-control">{{{ Input::old('notessource') }}}</textarea>
                </div>
            </div>
            <!-- Content / version -->
            <div class="form-group {{ $errors->first('notesversion', 'has-error') }}">
                <label for="notesversion" class="col-sm-2 control-label">@lang('admin/posts/form.notesversion')</label>
                <div class="col-sm-10">
                {{ $errors->first('notesversion', '<span class="help-block">:message</span>') }}
                    <textarea rows="4" id="notesversion" name="notesversion" class="form-control">{{{ Input::old('notesversion') }}}</textarea>
                </div>
            </div>                        
            <!-- Content -->
            <div class="form-group {{ $errors->first('content', 'has-error') }}">
                <label for="content" class="col-sm-2 control-label">@lang('admin/posts/form.content')</label>
                <div class="col-sm-10">
                {{ $errors->first('content', '<span class="help-block">:message</span>') }}
                    <textarea rows="4" id="content" name="content" class="form-control">{{{ Input::old('content') }}}</textarea>
                </div>
            </div>   

        </div><!-- /End tab -->

        <!-- Meta Data tab -->
        <div class="tab-pane" id="tab-meta-data">
        <br>
            <!-- Meta Title -->
            <div class="form-group {{ $errors->first('meta-title', 'has-error') }}">
                <label for="meta-title" class="col-sm-2 control-label">@lang('admin/posts/form.metatitle')</label>
                    <div class="col-sm-5">
                        <input type="text" id="meta-title" name="meta-title" class="form-control" value="{{{ Input::old('meta-title') }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('meta-title', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Meta Description -->
            <div class="form-group {{ $errors->first('meta-description', 'has-error') }}">
                <label for="meta-description" class="col-sm-2 control-label">@lang('admin/posts/form.metadescription')</label>
                    <div class="col-sm-5">
                        <input type="text" id="meta-description" name="meta-description" class="form-control" value="{{{ Input::old('meta-description') }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('meta-description', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Meta Keywords -->
            <div class="form-group {{ $errors->first('meta-keywords', 'has-error') }}">
                <label for="meta-keywords" class="col-sm-2 control-label">@lang('admin/posts/form.metakeywords')</label>
                    <div class="col-sm-5">
                        <input type="text" id="meta-keywords" name="meta-keywords" class="form-control" value="{{{ Input::old('meta-keywords') }}}">
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('meta-keywords', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

        </div>
    </div>

    <!-- Form actions -->
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a class="btn btn-link" href="{{ route('posts') }}">@lang('button.cancel')</a>
            <button type="submit" class="btn btn-default">@lang('button.publish')</button>
        </div>
    </div>

</form>
@stop
