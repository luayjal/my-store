<x-dashboard-layout title="Products">


    <x-alert >
    </x-alert>
    <div class="table-toolbar mb-3">
        <a href="{{route('admin.products.create')}}" class="btn btn-info">Create New</a>
    </div>
  
     <form action="{{URL::current()}}" method="get" class="d-flex">
        <input type="text" name="name" class="form-control me-2" placeholder="Search By Name">
        <select name="parent_id" class="form-control me-2">
            <option value="">All Categories</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
    </form>
   
    <table class="table">
        <thead>
            <tr>
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
                <th>{{$product->id}}</th>
                <th><a href="{{ route('admin.products.edit',$product->id) }}"> {{$product->name}}</a></th>
                <th>{{$product->category->name}}</th>
                <th>{{$product->price}}</th>
                <th>{{$product->quantity}}</th>
                <th>{{$product->status}}</th>
                <th>{{$product->created_at}}</th>
                
                <th>
                    <form action="{{ route('admin.products.destroy',$product->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
   <!--  {{ $products->links('vendor.pagination.bootstrap-4') }}     -->
   {{ $products->links() }} 

</x-dashboard-layout>