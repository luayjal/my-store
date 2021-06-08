<x-dashboard-layout title="Create Category">


<form action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.categories._form',[
    'lable_btn'=>'Add'
    ])
</form>
</x-dashboard-layout>
