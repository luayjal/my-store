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
<div class="form-group mb-3">
    <label for="">Name:</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}"
        class="form-control col-7 @error('name') is-invalid @enderror">
    @error('name')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Category:</label>
    <select name="category_id" class="form-control col-7 @error('parent_id') is-invalid @enderror">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if ($category->id == old('category_id', $product->category_id)) selected @endif>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Description:</label>
    <textarea name="description"
        class="form-control col-7 @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
    @error('description')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">Image:</label>
    <div><img src="{{ $product->image_url }}" height="200" class="mb-3"></div>

    <div class="input-group ">
        <div class="custom-file col-7">
            <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile"></label>
        </div>

    </div>
    @error('image')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">Gallery:</label>
    <div class="row">
        @foreach ($product->images as $image)
            <div class="col-md-2 text-center">
                <img src="{{ $image->image_url }}" id="imageId" alt="" height="80" class="img-fit m-1 border">
                <button class="btn btn-sm btn-danger" id="deleteGallery"
                    onclick="deleteImage('{{ $image->id }}')">Delete</button>

            </div>
        @endforeach
    </div>
    <div class="input-group">
        <div class="custom-file col-7">
            <input type="file" class="custom-file-input" multiple name="gallery[]" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile"></label>
        </div>

    </div>
    @error('gallery')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Price:</label>
    <div class="input-group  col-7">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        <input type="text" name="price" class="form-control">
        <div class="input-group-append">
            <span class="input-group-text">.00</span>
        </div>
    </div>
</div>
<div class="form-group mb-3">
    <label for="">Sale Price:</label>
    <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}"
        class="form-control col-7 @error('sale_price') is-invalid @enderror">
    @error('sale_price')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">Quantity:</label>
    <input type="number" name="quantity" value="{{ old('name', $product->quantity) }}"
        class="form-control col-7 @error('quantity') is-invalid @enderror">
    @error('quantity')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Status:</label>
    <div>
        <label><input type="radio" name="status" value="in-stock" @if (old('status', $product->status) == 'in-stock') checked @endif>
            in-stock</label>
        <label><input type="radio" name="status" value="sold-out" @if (old('status', $product->status) == 'sold-out') checked @endif>
            sold-out</label>
        <label><input type="radio" name="status" value="draft" @if (old('status', $product->status) == 'draft') checked @endif>
            draft</label>
    </div>
    @error('status')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Tags:</label>
    <input type="text" name="tags" value="{{ old('name', $tags) }}"
        class="tagify form-control col-7 @error('tags') is-invalid @enderror">
    @error('tags')
        <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $lable_btn ?? 'save' }}</button>
</div>

@push('css')
    <link rel="stylesheet" href="{{ asset('js/tagify/tagify.css') }}">
@endpush
@push('js')
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script src="{{ asset('js/tagify/jQuery.tagify.min.js') }}"></script>
    <script src="{{ asset('js/tagify/tagify.min.js') }}"></script>
    <script>
        var inputElm = document.querySelector('.tagify'),
            tagify = new Tagify(inputElm);


        function deleteImage(id) {
            document.querySelector('#imageId').value = id;
            document.querySelector('#deleteGallery').submit();
        }
    </script>
@endpush
