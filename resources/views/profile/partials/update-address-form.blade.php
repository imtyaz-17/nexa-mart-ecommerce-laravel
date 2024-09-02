<div class="card">
    <div class="card-header">
        <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
    </div>
    <form action="{{ route('profile.address.update') }}" method="POST" name="addressForm" id="addressForm">
        @csrf
        @method('PUT')
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name"
                           value="{{ old('first_name', $address->first_name ?? '') }}"
                           class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter Your First Name">
                    @error('first_name')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name"
                           value="{{ old('last_name', $address->last_name ?? '') }}"
                           class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter Your Last Name">
                    @error('last_name')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email"
                           value="{{ old('email', $address->email ?? '') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email">
                    @error('email')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" id="mobile"
                           value="{{ old('mobile', $address->mobile ?? '') }}"
                           class="form-control @error('mobile') is-invalid @enderror"
                           placeholder="mobile">
                    @error('mobile')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <textarea name="address" id="address" cols="30" rows="2"
                              placeholder="Address"
                              class="form-control @error('address') is-invalid @enderror">{{ old('address', $address->address ?? '') }}</textarea>
                    @error('address')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <input type="text" name="apartment" id="apartment"
                           value="{{ old('apartment', $address->apartment ?? '') }}"
                           class="form-control @error('apartment') is-invalid @enderror"
                           placeholder="Apartment, suite, unit, etc. (optional)">
                    @error('apartment')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" name="city" id="city"
                           value="{{ old('city', $address->city ?? '') }}"
                           class="form-control @error('city') is-invalid @enderror"
                           placeholder="City">
                    @error('city')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" name="state" id="state"
                           value="{{ old('state', $address->state ?? '') }}"
                           class="form-control @error('state') is-invalid @enderror"
                           placeholder="State">
                    @error('state')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" name="zip" id="zip"
                           value="{{ old('zip', $address->zip ?? '') }}"
                           class="form-control @error('zip') is-invalid @enderror"
                           placeholder="Zip">
                    @error('zip')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <select name="country" id="country"
                                class="form-control @error('country') is-invalid @enderror">
                            <option value="">Select a Country</option>
                            @if($countries->isNotEmpty())
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @selected(!empty($address) && $address->country_id == $country->id)>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('country')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="d-flex">
                    <button class="btn btn-dark">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
