<x-dashboard-layout title="Edit Category">

    <form action="{{route('admin.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    @include('admin.products._form',[
    'lable_btn'=>'Update'
    ])
    </form>
</x-dashboard-layout>
