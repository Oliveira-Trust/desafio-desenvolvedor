{!! Form::open(['route' => ['products.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('products.show', $id) }}" class='btn btn-info btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('products.edit', $id) }}" class='btn btn-secondary btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-times"></i>', [
    'type' => 'submit',
    'class' => 'btn btn-danger btn-xs',
    'onclick' => "return confirm('Confirma?')"
    ]) !!}
</div>
{!! Form::close() !!}