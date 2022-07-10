@extends('backend.layouts.master')

@section('main-content')

<div class="card">
  <h5 class="card-header">Edit User</h5>
  <div class="card-body">
    <form method="post" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Name</label>
        <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{$user->name}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="inputEmail" class="col-form-label">Email</label>
        <input id="inputEmail" type="email" name="email" placeholder="Enter email" value="{{$user->email}}" class="form-control">
        @error('email')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      {{-- <div class="form-group">
            <label for="inputPassword" class="col-form-label">Password</label>
          <input id="inputPassword" type="password" name="password" placeholder="Enter password"  value="{{$user->password}}" class="form-control">
      @error('password')
      <span class="text-danger">{{$message}}</span>
      @enderror
  </div> --}}


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
    <div class="col-md-3">
      @if($user->photo!=null)
      <span>Uploaded image <br /></span>
      <img width="100px" height="100px" src="{{asset('/uploads/images/users'). '/' . $user->photo}}">
      @endif
    </div>
    <div id="holder" style="margin-top:15px;max-height:100px;"></div>

    @error('photo')
    <span class="text-danger">{{$message}}</span>
    @enderror
  </div>
  @php
  $roles=DB::table('users')->select('role')->where('id',$user->id)->get();
  // dd($roles);
  @endphp
  <div class="form-group">
    <label for="role" class="col-form-label">Role</label>
    <select name="role" class="form-control">
      <option value="">-----Select Role-----</option>
      @foreach($roles as $role)
      <option value="{{$role->role}}" {{(($role->role=='admin') ? 'selected' : '')}}>Admin</option>
      <option value="{{$role->role}}" {{(($role->role=='user') ? 'selected' : '')}}>User</option>
      @endforeach
    </select>
    @error('role')
    <span class="text-danger">{{$message}}</span>
    @enderror
  </div>
  <div class="form-group">
    <label for="status" class="col-form-label">Status</label>
    <select name="status" class="form-control">
      <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>Active</option>
      <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>Inactive</option>
    </select>
    @error('status')
    <span class="text-danger">{{$message}}</span>
    @enderror
  </div>
  <div class="form-group mb-3">
    <button class="btn btn-success" type="submit">Update</button>
  </div>
  </form>
</div>
</div>

@endsection

@push('scripts')
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