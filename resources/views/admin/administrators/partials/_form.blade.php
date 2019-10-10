<div class="form-row">
    <div class="form-group col-lg-4 col-md-12">
        <label for="input-name" class="col-form-label">Nombre:</label>
        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
               value="{{old('name',!empty($user) ? $user->name: '' )}}" id="input-name" name="name"
            {{!empty($user) ? 'readonly': '' }}>
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="input-email" class="col-form-label">Email:</label>
        <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' :'' }}"
               value="{{old('email',!empty($user) ? $user->email: '')}}" id="input-email" name="email"
            {{!empty($user) ? 'readonly': '' }}>
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>
    <div class="form-group col-lg-4 col-md-12 {{$errors->has('rol') ? 'is-invalid' :'' }}">
        <label for="rol" class="col-form-label ">Rol</label>
        <select id="rol" data-style="btn-white"
                class="form-control selectpicker show-tick {{$errors->has('rol') ? 'is-invalid' :'' }}" name="rol"
                title="Selecciona un rol...">
            @foreach ($roles as $rol)
                <option value="{{ $rol->slug }}"
                    {{ old('rol',!empty($user) ? $user->roles->first()->slug: '') == $rol->slug ? 'selected' : '' }}>
                    {{ $rol->name }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('rol_id'))
            <div class="invalid-feedback">
                {{ $errors->first('rol_id') }}
            </div>
        @endif
    </div>
    @if (!Request::is('admin/administradores/crear'))
        <div class="form-group col-lg-4 col-md-12">
            <div class="custom-control custom-checkbox checkbox-form ">
                <input type="checkbox" name="status" id="status" class="custom-control-input"
                    {{!empty($user) ? ($user->status ? 'checked="checked"' : ''):''}}>
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
    <a href="{{route('administradores.index')}}" class="btn btn-secondary btn-icon-split btn-sm">
        <span class="icon text-white-50">
            <i class="fas fa-long-arrow-alt-left fa-sm text-white-50"></i>
        </span>
        <span class="text">Cancelar</span>
    </a>
</div>
