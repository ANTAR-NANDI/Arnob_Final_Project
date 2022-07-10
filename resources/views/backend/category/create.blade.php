@extends('backend.layouts.master')

@section('main-content')

<div class="card">
  <h5 class="card-header">Add Category</h5>
  <div class="card-body">
    <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="summary" class="col-form-label">Summary</label>
        <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
        @error('summary')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="is_parent">Is Parent</label><br>
        <input type="checkbox" name='is_parent' id='is_parent' value='1' checked> Yes
      </div>
      <!-- Parent Category Add -->

      <div class="form-group d-none" id='parent_cat_div'>
        <label for="parent_id">Parent Category</label>
        <select name="parent_id" class="form-control">
          <option value="">--Select any category--</option>
          @foreach($parent_cats as $key=>$parent_cat)
          <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
        <div class="input-group">
          <span class="input-group-btn">
            <input type="file" id="cat_image" name="photo" class="form-control" />
          </span>

        </div>
        <div class="col-md-12 mb-2">
          <img id="preview-image-before-upload" src="{{asset('backend/img/avatar.png')}}" alt="preview image" style="max-height: 250px;">
        </div>
        @error('photo')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control">
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
        @error('status')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button>
        <button class="btn btn-success" type="submit">Submit</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<!-- <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script> -->
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
  // $('#lfm').filemanager('image');

  $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
      tabsize: 2,
      height: 120
    });
  });
</script>

<script>
  $('#cat_image').change(function() {

    let reader = new FileReader();

    reader.onload = (e) => {

      $('#preview-image-before-upload').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]);

  });
  $('#is_parent').change(function() {
    var is_checked = $('#is_parent').prop('checked');
    // alert(is_checked);
    if (is_checked) {
      $('#parent_cat_div').addClass('d-none');
      $('#parent_cat_div').val('');
    } else {
      $('#parent_cat_div').removeClass('d-none');
    }
  })
</script>
@endpush