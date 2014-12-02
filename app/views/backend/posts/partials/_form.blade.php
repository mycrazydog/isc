    <!-- Tabs Content -->
    <div class="tab-content">

        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
            <br>
            
            <div class="form-group">
            	<div class="col-sm-12">
            <p>{{ Form::file('filePartnerLogo') }}</p>
            <?php	
            if (isset($post->filePartnerLogo)) {	
            if (($post->filePartnerLogo != '')){
            	echo "<div class='alert alert-block'><h4>Previously uploaded file:</h4><img src='/logos/".$post->filePartnerLogo."'></div>";	
            }
            }			
            ?>	
            </div>
            </div>
            
            
            
            <!-- Post Title -->
            <div class="form-group {{ $errors->first('title', 'has-error') }}">
                <label for="title" class="col-sm-3 control-label">@lang('admin/posts/form.posttitle')</label>
                <div class="col-sm-5">
                	{{ Form::text('title', null, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <!-- Post Slug -->
            <div class="form-group {{ $errors->first('slug', 'has-error') }}">
                <label for="slug" class="col-sm-3 control-label">@lang('admin/posts/form.slug')</label>
                <div class="col-sm-3">
                    {{ Form::text('slug', null, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('slug', '<span class="help-block">:message</span>') }}
                </div>
            </div>


            <div class="form-group {{ $errors->first('partnerwebsite', 'has-error') }}">
                    <label for="partnerwebsite" class="col-sm-3 control-label">@lang('admin/posts/form.partnerwebsite')</label>
                    <div class="col-sm-9">
                     {{ Form::text('partnerwebsite', null, ['class' => 'form-control']) }}
                    {{ $errors->first('partnerwebsite', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!--STATUS GOES HERE-->
            <div class="form-group {{ $errors->first('status', 'has-error') }}">
                <label for="status" class="col-sm-3 control-label">@lang('admin/posts/form.status')</label>
                    <div class="col-sm-5">
                    {{ Form::select('status_id', array('2' => 'Coming', '1' => 'Processing', '0' => 'Available'), null, array('id' => 'Status')) }}
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('status', '<span class="help-block">:message</span>') }}
                    </div>
            </div>
            
            <!--TAGS GOES HERE-->
            <div class="form-group {{ $errors->first('tags', 'has-error') }}">
                <label for="tags" class="col-sm-3 control-label">@lang('admin/posts/form.tags')</label>
                    <div class="col-sm-5">
                    {{ Form::select('tags', array('' => 'Please Select', '0' => 'Arts, Recreation and Cultural Life', '1' => 'Demographics', '2' => 'Economy', '3' => 'Education', '4' => 'Environment', '5' => 'Government and Citizen Participation', '6' => 'Health', '7' => 'Housing', '8' => 'Public Safety', '9' => 'Social Well-Being', '10' => 'Transportation'), null, array('id' => 'tags')) }}
                    </div>
                    <div class="col-sm-4">
                        {{ $errors->first('status', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- yearsavailable-->
            <div class="form-group {{ $errors->first('yearsavailable', 'has-error') }}">
                    <label for="yearsavailable" class="col-sm-3 control-label">@lang('admin/posts/form.yearsavailable')</label>
                    <div class="col-sm-9">
                    {{ Form::textarea('yearsavailable', null, ['class' => 'form-control']) }}
                    {{ $errors->first('yearsavailable', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!--notescleaning-->
            <div class="form-group {{ $errors->first('notescleaning', 'has-error') }}">
                    <label for="notescleaning" class="col-sm-3 control-label">@lang('admin/posts/form.notescleaning')</label>
                    <div class="col-sm-9">
                    {{ Form::textarea('notescleaning', null, ['class' => 'form-control']) }}
                    {{ $errors->first('notescleaning', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!--notessource-->
            <div class="form-group {{ $errors->first('notessource', 'has-error') }}">
                    <label for="notessource" class="col-sm-3 control-label">@lang('admin/posts/form.notessource')</label>
                    <div class="col-sm-9">
                     {{ Form::textarea('notessource', null, ['class' => 'form-control']) }}
                     {{ $errors->first('notessource', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!--notesversion-->
            <div class="form-group {{ $errors->first('notesversion', 'has-error') }}">
                    <label for="notesversion" class="col-sm-3 control-label">@lang('admin/posts/form.notesversion')</label>
                    <div class="col-sm-9">
                    {{ Form::textarea('notesversion', null, ['class' => 'form-control']) }}
                    {{ $errors->first('notesversion', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

            <!-- Content -->
            <div class="form-group {{ $errors->first('content', 'has-error') }}">
                    <label for="content" class="col-sm-3 control-label">@lang('admin/posts/form.content')</label>
                    <div class="col-sm-9">
                    {{ Form::textarea('content', null, ['class' => 'form-control']) }}
                    {{ $errors->first('content', '<span class="help-block">:message</span>') }}
                    </div>
            </div>

        </div><!--/.tab-pane -->

        <!-- Meta Data tab -->
        <div class="tab-pane" id="tab-meta-data">
            <br>
            <!-- Meta Title -->
            <div class="form-group {{ $errors->first('meta-title', 'has-error') }}">
                <label for="meta-title" class="col-sm-3 control-label">@lang('admin/posts/form.metatitle')</label>
                <div class="col-sm-5">
                    {{ Form::text('meta-title', null, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('meta-title', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <!-- Meta Description -->
            <div class="form-group {{ $errors->first('meta-description', 'has-error') }}">
                <label for="meta-description" class="col-sm-3 control-label">@lang('admin/posts/form.metadescription')</label>
                <div class="col-sm-5">
                    {{ Form::text('meta-description', null, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('meta-description', '<span class="help-block">:message</span>') }}
                </div>
            </div>

            <!-- Meta Keywords -->
            <div class="form-group {{ $errors->first('meta-keywords', 'has-error') }}">
                <label for="meta-keywords" class="col-sm-3 control-label">@lang('admin/posts/form.metakeywords')</label>
                <div class="col-sm-5">
                    {{ Form::text('meta-keywords', null, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    {{ $errors->first('meta-keywords', '<span class="help-block">:message</span>') }}
                </div>
            </div>

        </div><!--/.tab-pane -->

     </div><!--/.tab-content -->




    <!-- Form Actions -->
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a class="btn btn-link" href="{{ route('posts') }}">@lang('button.cancel')</a>
        <button type="submit" class="btn btn-default">@lang('button.publish')</button>
      </div>
    </div>
