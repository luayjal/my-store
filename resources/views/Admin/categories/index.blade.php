<x-dashboard-layout title="Categories">


    <x-alert />

    <div class="table-toolbar mb-3">
        <a href="{{route('admin.categories.create')}}" class="btn btn-info">Add New</a>
    </div>
    <form action="{{URL::current()}}" method="get" class="d-flex">
        <input type="text" name="name" class="form-control col-4 mx-2 me-2" placeholder="Search By Name">
        <select name="parent_id" class="form-control col-4 mx-2 me-2">
            <option value="">All Categories</option>
            @foreach($parents as $parent)
            <option value="{{$parent->id}}">{{$parent->name}}</option>
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
                <th>Parent Name</th>
                <th>Created at</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <th>{{$loop->iteration}}</th>
                <th>{{$category->id}}</th>
                <th>{{$category->name}}</th>
                <th>{{$category->parent->name}}</th>
                <th>{{$category->created_at}}</th>
                <th>{{$category->status}}</th>
                <th>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.edit',$category->id) }}"><i class="far fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('admin.categories.delete',$category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt "></i></button>
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>

</x-dashboard-layout>