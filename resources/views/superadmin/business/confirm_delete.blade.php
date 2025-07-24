@extends('layouts.app')
@section('title', 'تأكيد حذف العميل')

@section('content')
<section class="content-header">
    <h1>تأكيد حذف العميل</h1>
</section>

<section class="content">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">هل أنت متأكد أنك تريد حذف هذا العميل؟</h3>
        </div>
        <div class="box-body">
            <p><strong>اسم العميل:</strong> {{ $business->name }}</p>
            <p><strong>عدد الفواتير:</strong> {{ $counts->transactions }}</p>
            <p><strong>عدد المستخدمين:</strong> {{ $counts->users }}</p>
            <p><strong>عدد المنتجات:</strong> {{ $counts->products }}</p>

            <div class="alert alert-warning">
                <strong>تنبيه:</strong> لا يمكن استرجاع البيانات بعد الحذف، وسيتم حذف جميع الفواتير والمستخدمين والمنتجات المتعلقة بهذا العميل.
            </div>
        </div>
        <div class="box-footer">
            <form method="POST" action="{{ url('superadmin/business/' . $business->id . '/destroy') }}">
                @csrf
                <button type="submit" class="btn btn-danger">نعم، احذف العميل نهائيًا</button>
                <a href="{{ url()->previous() }}" class="btn btn-default">إلغاء</a>
            </form>
        </div>
    </div>
</section>
@endsection
