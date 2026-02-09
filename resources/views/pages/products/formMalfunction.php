        @if ($errors->any())
            <div class="card" style="padding:12px; border:1px solid #c00;">
                <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <!-- nome malfunzionamento -->
        <div class="form-space">
            <label class="form-label" for="name">Nome Malfunzionamento</label>
            <input class="form-input" type="text" id="name" name="name" value="{{ old('name', $malfunction?->name) }}" required>
        </div>

        <!-- prodotto associato malfunzionamento -->
        <div class="form-space">
            <label class="form-label" for="product_id">Prodotto Associato</label>
            <select class="form-input" id="product_id" name="product_id" required>
                <option value="">Seleziona un prodotto</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $malfunction?->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- descrizione malfunzionamento -->
        <div class="form-space">
            <label class="form-label" for="description">Descrizione Malfunzionamento</label>
            <textarea class="form-input" id="description" name="description" required>{{ old('description', $malfunction?->description) }}</textarea>
        </div>

        <!-- soluzione malfunzionamento -->
        <div class="form-space">
            <label class="form-label" for="solution">Soluzione Malfunzionamento</label>
            <textarea class="form-input" id="solution" name="solution" required>{{ old('solution', $malfunction?->solution) }}</textarea>
        </div>
        