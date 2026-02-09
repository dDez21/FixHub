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
            <select class="list-space" name="category_id" id="category_id" required >
                <option value="tech"  @selected($product?->category?->name==='tech')>Tecnico</option>
                <option value="staff" @selected($product?->category?->name==='staff')>Staff</option>
                <option value="admin" @selected($product?->category?->name==='admin')>Admin</option>                
            </select>
    </div>