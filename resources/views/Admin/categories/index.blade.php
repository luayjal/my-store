<x-dashboard-layout title="Categories">


    <x-alert />

    <div class="table-toolbar mb-3">
        <a href="{{route('admin.categories.create')}}" class="btn btn-info">Add New</a>
    </div>
    <form action="{{URL::current()}}" method="get" class="d-flex">
        <input type="text" name="name" class="form-control me-2" placeholder="Search By Name">
        <select name="parent_id" class="form-control me-2">
            <option value="">All Categories</option>
            @foreach($parents as $parent)
            <option value="{{$parent->id}}">{{$parent->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
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
                <th>{{$category->id}}</th>
                <th><a href="{{ route('admin.categories.edit',$category->id) }}"> {{$category->name}}</a></th>
                <th>{{$category->parent->name}}</th>
                <th>{{$category->created_at}}</th>
                <th>{{$category->status}}</th>
                <th>
                    <form action="{{ route('admin.categories.delete',$category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>

</x-dashboard-layout>