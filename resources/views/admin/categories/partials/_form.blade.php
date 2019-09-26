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
    <button class="btn btn-success btn-icon-split btn-sm" type="submit">
        <span class="icon text-white-50">
            <i class="fas fa-save fa-sm text-white-50"></i>
        </span>
        <span class="text">Guardar</span>
    </button>
    <a href="{{route('categorias.index')}}" class="btn btn-secondary btn-icon-split btn-sm">
        <span class="icon text-white-50">
            <i class="fas fa-long-arrow-alt-left fa-sm text-white-50"></i>
        </span>
        <span class="text">Cancelar</span>
    </a>
</div>