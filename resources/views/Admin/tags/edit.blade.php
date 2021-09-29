
<x-dashboard-layout title="create Tag">

@if ($errors->any())
    <div class="alert alert-danger">
        Errors
        <ul>
            @foreach ($errors->all() as $messages)
                <li>{{ $messages }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('admin.tags.update',$tag->id)}}" method="post">
    @csrf
    @method('put')
<div class="form-group mb-3">
    <label for="">Tags:</label>
    <input type="text" name="name" value="{{ old('name',$tag->name)}}"   
        class="form-control col-7 @error('tags') is-invalid @enderror">
    @error('tags')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="">Status:</label>
    <div class="custom-control custom-radio">
      <input name="status" class="custom-control-input @error('status') is-invalid @enderror" type="radio" id="customRadio1" @if($tag->status == 'active')checked @endif value="active">
      <label for="customRadio1" class="custom-control-label">Active</label>
    </div>
    <div class="custom-control custom-radio">
      <input name="status" class="custom-control-input @error('status') is-invalid @enderror" type="radio" id="customRadio2" @if($tag->status == 'inactive')checked @endif value="inactive">
      <label for="customRadio2" class="custom-control-label">Inactive</label>
    </div>
  </div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">create</button>
</div>
</form>
@push('js')
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
</x-dashboard-layout>