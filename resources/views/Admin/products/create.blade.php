<x-dashboard-layout title="Create Product">


    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.products._form',[
        'lable_btn'=>'Create'
        ])
    </form>
</x-dashboard-layout>
