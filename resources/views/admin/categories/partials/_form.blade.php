<div class="form-row">
    <div class="form-group col-lg-6 col-md-12">
        <label for="input-name" class="col-form-label">Nombre:</label>
        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
               value="{{old('name',!empty($category) ? $category->name: '' )}}" id="input-name" name="name">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
    <div class="form-group col-lg-6 col-md-12">
        <label for="input-description" class="col-form-label">Descripción:</label>
        <input type="text" class="form-control"
               value="{{old('description',!empty($category) ? $category->description: '' )}}" id="input-description"
               name="description">
    </div>
    @if (!Request::is('admin/categorias/crear'))
        <div class="form-group col-lg-6 col-md-12">
            <div class="custom-control custom-checkbox checkbox-form ">
                <input type="checkbox" name="status" id="status" class="custom-control-input"
                    {{!empty($category) ? ($category->status ? 'checked="checked"' : ''):''}}>
                <label class="custom-control-label" for="status">Status</label>
            </div>
        </div>
    @endif
</div>
<div class="btn-action">
    <button class="button button-blue-primary" type="submit">
        Guardar
    </button>
    <a href="{{route('categorias.index')}}" class="button button-blue-secondary">
        Cancelar
    </a>
</div>
