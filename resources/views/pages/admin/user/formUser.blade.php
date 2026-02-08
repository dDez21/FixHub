        @if ($errors->any())
            <div class="card" style="padding:12px; border:1px solid #c00;">
                <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif


        @php
            $role = old('role', $user?->role ?? 'tech');
            $isTech = ($role === 'tech');
            $isStaff = ($role === 'staff');
            $showCategories = ($isTech || $isStaff);

            $centerSelected = old('center_id', $user?->tech?->center_id);

            // categorie prese in base al ruolo
            $selectedCategories = old(
                'categories',
                $isStaff
                    ? ($user?->staff?->categories?->pluck('id')->all() ?? [])
                    : ($user?->tech?->categories?->pluck('id')->all() ?? [])
            );
        @endphp

            <!-- nome -->
            <div class="form-space">
                <label class="form-label" for="name">Nome</label>
                <input class="form-input" type="text" id="name" name="name" value="{{ old('name', $user?->name) }}" required>
            </div>

            <!-- cognome -->
            <div class="form-space">
                <label class="form-label" for="surname">Cognome</label>
                <input class="form-input"type="text" id="surname" name="surname" value="{{ old('surname', $user?->surname) }}" required>
            </div>

            <!-- username -->
            <div class="form-space">
                <label class="form-label" for="username">Username</label>
                <input class="form-input"type="text" id="username" name="username" value="{{ old('username', $user?->username) }}" required>
            </div>


            <!-- password -->
            @if($user)

                <!-- modifico password -->
                <div class="form-space ppw ppw-toggle">
                    <label class="ppw-toggle-label">
                        <input type="checkbox" id="change-password-toggle">
                        <span>Cambia password</span>
                    </label>
                </div>

                <div id="password-box" class="ppw ppw-box" hidden>
                    <div class="form-space">
                        <label class="form-label" for="password">Nuova password</label>
                        <input class="form-input" type="password" id="password" name="password" disabled>
                    </div>

                    <div class="form-space">
                        <label class="form-label" for="password_confirmation">Conferma password</label>
                        <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" disabled>
                    </div>
                </div>
            @else

                <!-- creo password -->
                <div class="form-space">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-input" type="password" id="password" name="password" required>
                </div>
            @endif


            <!-- ruolo -->
            <div class="form-space">    
                <label class="form-label" for="role">Ruolo</label>
                <select class="list-space" name="role" id="role" required >
                    <option value="tech"  @selected($role==='tech')>Tecnico</option>
                    <option value="staff" @selected($role==='staff')>Staff</option>
                    <option value="admin" @selected($role==='admin')>Admin</option>                
                </select>
            </div>

            <!-- opzioni tecnico -->
            <div id="tech-options" @if(!$isTech) hidden @endif>

                <!-- data di nascita -->
                <div class="form-space">
                    <label class="form-label" for="birth_date">Data di nascita</label>
                    <input class="form-input"type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $user?->tech?->birth_date) }}" max="{{ now()->toDateString() }}">
                </div>


                <!-- centro associato -->
                <div class="form-space">
                    <label class="form-label" for="center">Centro</label>
                    <select name="center_id" id="center_id" class="list-space">                    
                        <option value="">Nessun centro</option>
                        
                        @foreach($centers as $center)
                            <option class="list-value" value="{{ $center->id }}" @selected((string)$centerSelected === (string)$center->id)>
                            {{ $center->name }}, {{ $center->city }}
                            </option>
                        @endforeach                    
                    </select>
                </div>


                    <!-- categorie -->
                    <div id="categories-options" @if(!$showCategories) hidden @endif>
                        <div class="form-group">
                            <p class="form-label">Categorie</p>

                            <div class="categories-box">
                                @foreach($categories as $category)
                                    <label class="category-item">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                            @checked(in_array($category->id, $selectedCategories))>
                                        <span>{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>   
            </div>
