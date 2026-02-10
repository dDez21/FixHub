@if ($errors->any())
  <div class="card" style="padding:12px; border:1px solid #c00;">
    <ul style="margin:0; padding-left:18px;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<!-- nome -->
<div class="form-space">
  <label class="form-label" for="name">Nome</label>
  <input class="form-input" type="text" id="name" name="name"
         value="{{ old('name', $center?->name) }}" required>
</div>

<!-- telefono -->
<div class="form-space">
  <label class="form-label" for="phone">Numero di telefono</label>
  <input class="form-input" type="tel" id="phone" name="phone"
         value="{{ old('phone', $center?->phone) }}" required>
</div>

<!-- email -->
<div class="form-space">
  <label class="form-label" for="email">Email</label>
  <input class="form-input" type="email" id="email" name="email"
         value="{{ old('email', $center?->email) }}" required>
</div>

<!-- regione -->
<div class="form-space">
  <label class="form-label" for="region_id">Regione</label>
  <select class="form-input" id="region_id" name="region_id" required>
    <option value="">Seleziona una regione</option>
    @foreach($regions as $r)
      <option value="{{ $r->id }}"
        @selected((string)old('region_id', $center?->region_id) === (string)$r->id)>
        {{ $r->name }}
      </option>
    @endforeach
  </select>
</div>

<!-- provincia -->
<div class="form-space">
  <label class="form-label" for="province_id">Provincia</label>
  <select class="form-input" id="province_id" name="province_id" required
          data-initial="{{ old('province_id', $center?->province_id) }}">
    <option value="">Seleziona una provincia</option>
    @isset($provinces)
      @foreach($provinces as $p)
        <option value="{{ $p->id }}"
          @selected((string)old('province_id', $center?->province_id) === (string)$p->id)>
          {{ $p->name }} ({{ $p->code }})
        </option>
      @endforeach
    @endisset
  </select>
</div>

<!-- città -->
<div class="form-space">
  <label class="form-label" for="city_id">Città</label>
  <select class="form-input" id="city_id" name="city_id" required
          data-initial="{{ old('city_id', $center?->city_id) }}">
    <option value="">Seleziona una città</option>
    @isset($cities)
      @foreach($cities as $c)
        <option value="{{ $c->id }}"
          @selected((string)old('city_id', $center?->city_id) === (string)$c->id)>
          {{ $c->name }}
        </option>
      @endforeach
    @endisset
  </select>
</div>

<!-- via -->
<div class="form-space">
  <label class="form-label" for="street">Via</label>
  <input class="form-input" type="text" id="street" name="street"
         value="{{ old('street', $center?->street) }}" required>
</div>

<!-- civico -->
<div class="form-space">
  <label class="form-label" for="civic">Numero Civico</label>
  <input class="form-input" type="text" id="civic" name="civic"
         value="{{ old('civic', $center?->civic) }}">
</div>

<script>
  window.GEO_BASE = "{{ url('/geo') }}";
</script>
