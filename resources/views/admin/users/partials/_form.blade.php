<div class="form-row">
    <div class="form-group col-lg-4 col-md-12">
        <label for="input-name" class="col-form-label">Nombre:</label>
        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
               value="{{old('name',!empty($user) ? $user->name: '' )}}" id="input-name" name="name">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="input-email" class="col-form-label">Email:</label>
        <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' :'' }}"
               value="{{old('email',!empty($user) ? $user->email: '')}}" id="input-email" name="email">
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>
    <div class="form-group col-lg-4 col-md-12 {{$errors->has('rol') ? 'is-invalid' :'' }}">
        <label for="rol" class="col-form-label ">Rol</label>
        <select id="rol" class="form-control selectpicker {{$errors->has('rol') ? 'is-invalid' :'' }}" name="rol">
            <option selected value=" ">Selecciona un rol</option>
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
    <div class="form-group col-lg-4 col-md-12">
        <label for="input-password" class="col-form-label">Contraseña:</label>
        <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' :'' }}"
               value="{{old('password')}}" id="input-password" name="password">
        @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="input-password_confirmation" class="col-form-label">Confirmar contraseña:</label>
        <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' :'' }}"
               value="{{old('password_confirmation')}}" id="input-password_confirmation" name="password_confirmation">
    </div>
    @if (!Request::is('admin/usuarios/crear'))
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
    <a href="{{route('usuarios.index')}}" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-ban fa-sm text-white-50"></i>
                    </span>
        <span class="text">Cancelar</span>
    </a>
</div>
