<!-- Modal Create Course-->
<div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-labelledby="newProductModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <form enctype="multipart/form-data" class="form-course needs-validation" method="POST"
        action="{{route('productos.store')}}" role="form" autocomplete="off">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newProductModalLabel">Agregar nombre del producto:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-12">
                        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
                            value="{{old('name')}}" id="input-name" name="name"
                            placeholder="Ingresa nombre del producto" required> @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        Crear Producto
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>