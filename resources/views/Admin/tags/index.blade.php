<x-dashboard-layout title="Products">

    
    <div class="col-8 text-center">
        <x-alert >
        </x-alert>
    </div>
    <div class="table-toolbar mb-3">
        <a href="{{route('admin.tags.create')}}" class="btn btn-sm btn-info">Create New <i class="fas fa-plus"></i></a>
    </div>
  
     
   
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>num</th>
                <th>ID</th>
                <th>Name</th>
                <th>products</th>
                <th>status</th>
                <th>operation</th>
            
                
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
            <tr>
                <th>{{$loop->iteration}}</th>
                <th>{{$tag->id}}</th>
                <th> {{$tag->name}}</th>
                <th>{{$tag->products->count()}}</th> 
                <th>{{$tag->status}}</th> 
                <th>
                    <a href="{{ route('admin.tags.edit',$tag->id) }}" class="btn btn-sm btn-outline-primary"><i class="far fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('admin.tags.destroy',$tag->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt "></i></button>
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
   <!--  {{ $tags->links('vendor.pagination.bootstrap-4') }}     -->
   {{ $tags->links() }} 

</x-dashboard-layout>