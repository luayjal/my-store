<x-dashboard-layout title="Create Product">


<form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.products._form',[
    'lable_btn'=>'Add'
    ])
</form>
</x-dashboard-layout>
