@extends('admin.layouts.admin')

@section('content')
    <h3>Welcome to admin</h3>
    <form>
        <x-rich-text-editor name="venue" required="required"></x-rich-text-editor>
        <button>Submit</button>
    </form>
@endsection
