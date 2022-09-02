<form>
    @csrf
    <!-- {{ csrf_field() }} -->
    @foreach($form->getFields() as $field)
        {{$field->render()}}
    @endforeach

</form>