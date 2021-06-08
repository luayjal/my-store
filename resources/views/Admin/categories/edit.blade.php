<x-dashboard-layout title="Edit Category">

<form action="{{route('admin.categories.update',$id)}}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    @include('admin.categories._form',[
    'lable_btn'=>'Update'
    ])
    </form>
</x-dashboard-layout>
