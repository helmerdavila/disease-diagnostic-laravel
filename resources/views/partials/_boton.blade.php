<div class="btn-group">
    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-gear"></i>  <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="{{ route($editRoute, Hashids::encode($object->id)) }}">
            <i class="fa fa-pencil"></i> Editar</a>
        </li>
        <li>
            <a href="" data-toggle="modal" data-target="#deleteModal"
                data-title="{{ $name }}" data-content="{{ $content }}"
                data-route="{{ route($deleteRoute, Hashids::encode($object->id)) }}">
            <i class="fa fa-times"></i> Eliminar</a>
        </li>
    </ul>
</div>
