@if ($errors->any())
    <div class="card" style="padding:12px; border:1px solid #c00;">
        <ul style="margin:0; padding-left:18px;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


    <!-- nome prodotto -->
    <div class="form-space">
        <label class="form-label" for="name">Nome Prodotto</label>
        <input class="form-input" type="text" id="name" name="name" value="{{ old('name', $product?->name) }}" required>
    </div>


    <!-- categoria prodotto -->
    <div class="form-space">
        <label class="form-label" for="category_id">Categoria prodotto</label>

        <select class="list-space" id="category_id" name="category_id" required>
            <option value="" disabled {{ old('category_id', $product->category_id ?? '') === '' ? 'selected' : '' }}>
                Seleziona una categoria
            </option>

            @foreach($categories as $cat)
                <option class="list-value" value="{{ $cat->id }}" {{ (string) old('category_id', $product->category_id ?? '') === (string) $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>


    <!-- descrizione prodotto -->
    <div class="form-space">
        <label class="form-label" for="description">Descrizione</label>
        <textarea class="form-input" id="description" name="description" required>{{ old('description', $product?->description) }}</textarea>
    </div>


    <!-- tecniche d'uso -->
    <div class="form-space">
        <label class="form-label" for="use_techniques">Tecniche d'uso</label>
        <textarea class="form-input" id="use_techniques" name="use_techniques" required>{{ old('use_techniques', $product?->use_techniques) }}</textarea>
    </div>


    <!-- installazione -->
    <div class="form-space">
        <label class="form-label" for="installation">Guida all'installazione</label>
        <textarea class="form-input" id="installation" name="installation" required>{{ old('installation', $product?->installation) }}</textarea>
    </div>


    <!-- Foto prodotto -->
    <div class="form-space">
        <label class="form-label" for="photo">Foto</label>

        <div class="photo-box">
            <img
                id="photo-preview"
                src="{{ isset($product) && $product->photo ? Storage::url($product->photo) : asset('images/noPhoto.png') }}"
                alt="Anteprima foto"
                style="max-width: 220px; border-radius: 12px; display:block;"
            >
            
            <input
                id="photo"
                name="photo"
                type="file"
                accept="image/*"
                class="file-input"
            >
    </div>