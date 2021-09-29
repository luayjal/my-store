<x-dashboard-layout title="Products">


    <x-alert >
    </x-alert>
    <div class="table-toolbar mb-3">
        <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-info">Create New <i class="fas fa-plus"></i></a>
    </div>
  
     <form action="{{URL::current()}}" method="get" class="d-flex">
        <input type="text" name="name" class="form-control col-4 mx-2" placeholder="Search By Name">
        <select name="parent_id" class="form-control col-4 mx-2">
            <option value="">All Categories</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
    </form>
   
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>num</th>
                <th>ID</th>
                <th>Name</th>
                <th>category Name</th>
                <th>price</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Created at</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <th>{{$loop->iteration}}</th>
                <th>{{$product->id}}</th>
                <th> {{Str::limit($product->name,30, '...') }}</th>
                <th>{{$product->category->name}}</th>
                <th>{{$product->price}}</th>
                <th>{{$product->quantity}}</th>
                <th>{{$product->status}}</th>
                <th>{{$product->created_at}}</th>
                
                <th>
                    <a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-sm btn-outline-primary"><i class="far fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('admin.products.destroy',$product->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt "></i></button>
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
   <!--  {{ $products->links('vendor.pagination.bootstrap-4') }}     -->
   {{ $products->links() }} 

</x-dashboard-layout>