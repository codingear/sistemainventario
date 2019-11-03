<div class="form-row">
    <div class="form-group col-lg-4 col-md-12">
        <label for="name" class="col-form-label">Nombre Proveedor:</label>
        <input type="text" class="form-control" value="{{!empty($provider) ? $provider->name: '' }}" id="name"
            name="name">
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="contact_name" class="col-form-label">Nombre Contacto:</label>
        <input type="text" class="form-control" value="{{!empty($provider) ? $provider->contact_name: '' }}"
            id="contact_name" name="contact_name">
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="rfc" class="col-form-label">RFC:</label>
        <input type="text" class="form-control" value="{{!empty($provider) ? $provider->rfc: ''}}" id="rfc" name="rfc">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-lg-4 col-md-12">
        <label for="telephone" class="col-form-label">Teléfono:</label>
        <input type="text" class="form-control" value="{{!empty($provider) ? $provider->telephone: ''}}" id="telephone"
            name="telephone">
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="email" class="col-form-label">Email:</label>
        <input type="email" class="form-control" value="{{!empty($provider) ? $provider->email: ''}}" id="email"
            name="email">
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="website" class="col-form-label">Sitio Web:</label>
        <input type="text" class="form-control" value="{{!empty($provider) ? $provider->website: ''}}" id="website"
            name="website">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-lg-4 col-md-12">
        <label for="state_id" class="col-form-label ">Estado:</label>
        <select id="state_id" data-style="btn-white" class="form-control selectpicker show-tick" name="state_id"
            title="Selecciona un estado..." data-live-search="true">
            @foreach ($states as $state)
            <option value="{{ $state->id }}"
                {{ old('state_id',!empty($provider) ? $provider->state_id: '') == $state->id ? 'selected' : '' }}>
                {{ $state->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="city" class="col-form-label">Ciudad:</label>
        <input type="text" class="form-control" value="{{!empty($provider) ? $provider->city: ''}}" id="city"
            name="city">
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="zip_code" class="col-form-label">Código Postal:</label>
        <input type="text" class="form-control" value="{{!empty($provider) ? $provider->zip_code: ''}}" id="zip_code"
            name="zip_code">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-lg-8 col-md-12">
        <label for="address" class="col-form-label">Dirección:</label>
        <input type="text" class="form-control" value="{{!empty($provider) ? $provider->address: ''}}" id="address"
            name="address">
    </div>
    <div class="form-group col-lg-4 col-md-12">
        <label for="notes" class="col-form-label">Notas:</label>
        <textarea class="form-control" id="notes" rows="2"
            name="notes">{{!empty($provider) ? $provider->notes: '' }}</textarea>
    </div>
</div>
<div class="btn-action">
    <button class="button button-blue-primary" type="submit">
        Guardar
    </button>
    <a href="{{route('proveedores.index')}}" class="button button-blue-secondary">
        Cancelar
    </a>
</div>
@push('optional_scripts')
<script src="{{ asset('vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script>
    $(document).ready(function () {
            $('#state_id').selectpicker({
                "noneResultsText": 'No hay coincidencias.'
            });
        });
</script>
@endpush
