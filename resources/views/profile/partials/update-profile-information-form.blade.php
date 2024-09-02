<div class="card">
    <div class="card-header">
        <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
    </div>
    <form action="{{ route('profile.update') }}" method="POST" name="profileForm" id="profileForm">
        @csrf
        @method('PUT')
        <div class="card-body p-4">
            <div class="row">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Your Name"
                           class="form-control  @error('name') is-invalid @enderror"
                           value="{{$user->name}}">
                    @error('name')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter Your Email"
                           class="form-control" value="{{$user->email}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" placeholder="Enter Your Phone"
                           class="form-control  @error('phone') is-invalid @enderror"
                           value="{{$user->phone}}">
                    @error('phone')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex">
                    <button class="btn btn-dark">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
