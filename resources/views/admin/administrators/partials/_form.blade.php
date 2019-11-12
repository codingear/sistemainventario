<div class="form-row">
    <div class="form-group col-lg-4 col-md-12">
        <label for="name" class="col-form-label">Nombre:</label>
        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
               value="{{old('name',!empty($user) ? $user->name: '' )}}" id="name" name="name"
            {{!empty($user) ? 'readonly': '' }}>
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="email" class="col-form-label">Email:</label>
        <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' :'' }}"
               value="{{old('email',!empty($user) ? $user->email: '')}}" id="email" name="email"
            {{!empty($user) ? 'readonly': '' }}>

    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="rol" class="col-form-label ">Rol</label>
        <select id="rol" data-style="btn-white"
                class="form-control selectpicker show-tick" name="rol"
                title="Selecciona un rol...">
            @foreach ($roles as $rol)
                <option value="{{ $rol->slug }}"
                    {{ old('rol',!empty($user) ? $user->roles->first()->slug: '') == $rol->slug ? 'selected' : '' }}>
                    {{ $rol->name }}
                </option>
            @endforeach
        </select>
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
<div class="btn-action btn-action-mt">
    <button class="button button-blue-primary" id="submit-btn" type="submit">
         <span>
            {{ request()->is('admin/administradores/crear') ? 'Guardar' : 'Actualizar' }}
        </span>
    </button>
    <a href="{{route('administradores.index')}}" class="button button-blue-secondary">
        Volver
    </a>
</div>
