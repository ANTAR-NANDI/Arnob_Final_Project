@extends('backend.layouts.master')

@section('main-content')

<div class="card shadow mb-4">
  <div class="row">
    <div class="col-md-12">
      @include('backend.layouts.notification')
    </div>
  </div>
  <h5 class="card-header">Add User</h5>
  <div class="card-body">
    <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Name</label>
        <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{old('name')}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="inputEmail" class="col-form-label">Email</label>
        <input id="inputEmail" type="email" name="email" placeholder="Enter email" value="{{old('email')}}" class="form-control">
        @error('email')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="inputPassword" class="col-form-label">Password</label>
        <input id="inputPassword" type="password" name="password" placeholder="Enter password" value="{{old('password')}}" class="form-control">
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
        <div class="input-group">
          <span class="input-group-btn">
            <input type="file" id="user_image" name="photo" class="form-control" />
          </span>

        </div>
        <div class="col-md-12 mb-2">
          <img id="preview-image-before-upload" src="{{asset('backend/img/avatar.png')}}" alt="preview image" style="max-height: 250px;">
        </div>
        @error('photo')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      @php
      $roles=DB::table('users')->select('role')->get();
      @endphp
      <div class="form-group">
        <label for="role" class="col-form-label">Role</label>
        <select name="role" class="form-control">
          <option value="">-----Select Role-----</option>

          <option value="user">User</option>
          <option value="admin">Admin</option>

        </select>
        @error('role')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="status" class="col-form-label">Status</label>
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

@push('scripts')

<!-- <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>-->
<script>
  $('#user_image').change(function() {

    let reader = new FileReader();

    reader.onload = (e) => {

      $('#preview-image-before-upload').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]);

  });
</script>
@endpush