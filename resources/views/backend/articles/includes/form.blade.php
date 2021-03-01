<div class="form-group row">
    <label class="col-md-2 col-form-label" for="file-input">@lang('Image Upload') (*)</label>
    <div class="col-md-10">
        <input id="image" type="file" name="file">
    </div>
</div>

<div class="form-group row">
    <label for="title" class="col-md-2 col-form-label">@lang('Title')</label>

    <div class="col-md-10">
        <input type="text" name="title" class="form-control" placeholder="{{ __('Title') }}"
               value="{{ old('title', isset($article) ? $article->title : '') }}" maxlength="100" required/>
    </div>
</div><!--form-group-->

<div class="form-group row">
    <label for="sub_title" class="col-md-2 col-form-label">@lang('Sub Title')</label>

    <div class="col-md-10">
        <input type="text" name="sub_title" class="form-control" placeholder="{{ __('Sub Title') }}"
               value="{{ old('sub_title', isset($article) ? $article->sub_title : '') }}" maxlength="100" required/>
    </div>
</div><!--form-group-->

<div class="form-group row">
    <label for="body" class="col-md-2 col-form-label">@lang('Content')</label>

    <div class="col-md-10 pb-4">
        <textarea class="ckeditor form-control" name="content">{{ old('content', isset($article) ? $article->content : '') }}</textarea>
    </div>
</div><!--form-group-->
