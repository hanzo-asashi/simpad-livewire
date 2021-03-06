<div>
  <section id="page-account-settings">
    <div class="row">
      <!-- left menu section -->
      <div class="col-md-3 mb-2 mb-md-0">
        <div wire:ignore>
          <ul class="nav nav-pills flex-column nav-left">
            <!-- general -->
            <li class="nav-item">
              <a
                class="nav-link active"
                id="account-pill-general"
                data-bs-toggle="pill"
                href="#account-vertical-general"
                aria-expanded="true"
              >
                <i data-feather="user" class="font-medium-3 me-1"></i>
                <span class="fw-bold">Pribadi</span>
              </a>
            </li>
            <!-- information -->
            <li class="nav-item">
              <a
                class="nav-link"
                id="account-pill-info"
                data-bs-toggle="pill"
                href="#account-vertical-info"
                aria-expanded="false"
              >
                <i data-feather="info" class="font-medium-3 me-1"></i>
                <span class="fw-bold">Informasi</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!--/ left menu section -->

      <!-- right content section -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="tab-content">
              <!-- general tab -->
              <div
                role="tabpanel"
                class="tab-pane active"
                id="account-vertical-general"
                aria-labelledby="account-pill-general"
                aria-expanded="true"
              >
                <!-- header section Avatar -->
{{--                <div class="d-flex">--}}
{{--                  <a href="#" class="me-25">--}}
{{--                    @if ($avatar)--}}
{{--                      <img--}}
{{--                        src="{{ $avatar->temporaryUrl() }}"--}}
{{--                        id="avatar-img"--}}
{{--                        class="rounded me-50"--}}
{{--                        alt="avatar image"--}}
{{--                        height="80"--}}
{{--                        width="80"--}}
{{--                      />--}}
{{--                    @else--}}
{{--                      <img--}}
{{--                        src="{{asset('images/portrait/small/avatar-s-11.jpg')}}"--}}
{{--                        class="rounded me-50"--}}
{{--                        alt="profile image"--}}
{{--                        height="80"--}}
{{--                        width="80"--}}
{{--                      />--}}
{{--                    @endif--}}
{{--                  </a>--}}
{{--                  <!-- upload and reset button -->--}}
{{--                  <form wire:submit.prevent="saveAvatar">--}}
{{--                    <div class="mt-75 ms-1">--}}
{{--                      <label for="avatar" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>--}}
{{--                      <input type="file" id="avatar" name="avatar" wire:model="avatar" hidden accept="image/*" />--}}
{{--                      <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>--}}
{{--                      <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>--}}
{{--                      @error('avatar') <span class="error">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}
{{--                  </form>--}}
{{--                  <!--/ upload and reset button -->--}}
{{--                </div>--}}
                <!--/ header section avatar -->

                <!-- form -->
                <form wire.submit.prevent="submit" class="validate-form mt-2">
                  @csrf
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <x-label class="form-label" for="username">Username</x-label>
                        <input wire:model="username"
                               type="text"
                               class="form-control"
                               id="username"
                               name="username"
                               placeholder="Username"
                        />
                        @error('username') <span class="error">{{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <label class="form-label" for="password">Password</label>
                        <input wire:model="password"
                               type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               placeholder="Password"
                        />
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <label class="form-label" for="account-e-mail">E-mail</label>
                        <input wire:model="email"
                               type="email"
                               class="form-control"
                               id="account-e-mail"
                               name="email"
                               placeholder="Email"
                               value="granger007@hogward.com"
                        />
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <label class="form-label" for="selectRole">Role</label>
                        <select name="role" class="form-select" id="selectRole" wire:model="selectedRoles">
                          <option value="">Pilih Role</option>
                          @foreach($roles as $role)
                            <option wire:key="{{ $role->id }}" value={{ $role->name }}>{{ $role->name }}</option>
                          @endforeach
                        </select>
                        @error('role') <span class="error">{{ $message }}</span> @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="table-responsive border rounded mt-1">
                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock font-medium-3 me-25"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                          <span class="align-middle">Permission</span>
                        </h6>
                        <table class="table table-striped table-borderless">
                          <thead class="table-light">
                          <tr>
                            <th>Read</th>
                            <th>Write</th>
                            <th>Create</th>
                            <th>Delete</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            @foreach($permissionCrud as $key => $perm)
                              <td>
                                <div class="form-check">
                                  <input type="checkbox" name="permissions" class="form-check-input" id="permission" wire:model="selectedPermission" value="{{ $perm }}"
                                         wire:key="{{ $key }}">
                                  <label class="form-check-label" for="permission"></label>
                                </div>
                              </td>
                            @endforeach
                          </tr>
                          </tbody>
                          @error('permissions') <span class="error">{{ $message }}</span> @enderror
                        </table>
                      </div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary mt-2 me-1">Save changes</button>
                      <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                    </div>
                  </div>
                </form>
                <!--/ form -->
              </div>
              <!--/ general tab -->

              <!-- information -->
              <div
                class="tab-pane fade"
                id="account-vertical-info"
                role="tabpanel"
                aria-labelledby="account-pill-info"
                aria-expanded="false"
              >
                <!-- form -->
                <form class="validate-form">
                  <div class="row">
{{--                    <div class="col-12">--}}
{{--                      <div class="mb-1">--}}
{{--                        <label class="form-label" for="accountTextarea">Bio</label>--}}
{{--                        <textarea--}}
{{--                          class="form-control"--}}
{{--                          id="accountTextarea"--}}
{{--                          rows="4"--}}
{{--                          placeholder="Your Bio data here..."--}}
{{--                        ></textarea>--}}
{{--                      </div>--}}
{{--                    </div>--}}
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <label class="form-label" for="account-birth-date">Birth date</label>
                        <input
                          type="text"
                          class="form-control flatpickr"
                          placeholder="Birth date"
                          id="account-birth-date"
                          name="dob"
                        />
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <label class="form-label" for="accountSelect">Country</label>
                        <select class="form-select" id="accountSelect">
                          <option>USA</option>
                          <option>India</option>
                          <option>Canada</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <label class="form-label" for="account-birth-date">Birth date</label>
                        <input
                          type="text"
                          class="form-control flatpickr"
                          placeholder="Birth date"
                          id="account-birth-date"
                          name="dob"
                        />
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <label class="form-label" for="accountSelect">Country</label>
                        <select class="form-select" id="accountSelect">
                          <option>USA</option>
                          <option>India</option>
                          <option>Canada</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <label class="form-label" for="account-website">Website</label>
                        <input
                          type="text"
                          class="form-control"
                          name="website"
                          id="account-website"
                          placeholder="Website address"
                        />
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="mb-1">
                        <label class="form-label" for="account-phone">Phone</label>
                        <input
                          type="text"
                          class="form-control"
                          id="account-phone"
                          placeholder="Phone number"
                          value="(+656) 254 2568"
                          name="phone"
                        />
                      </div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                      <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                    </div>
                  </div>
                </form>
                <!--/ form -->
              </div>
              <!--/ information -->
            </div>
          </div>
        </div>
      </div>
      <!--/ right content section -->
    </div>
  </section>
</div>
@push('page-script')
  <script src="{{ asset(mix('js/scripts/components/components-modals.js')) }}"></script>
  <script>
    // let file = document.querySelector('input[type="file"]').files[0];
    // console.log(file);
    if(feather){
      feather.replace({});
    }
    // Upload a file:
    // @this.upload('avatar', file, (uploadedFilename) => {
    //   // Success callback.
    //   console.log(uploadedFilename);
    // }, (error) => {
    //   // Error callback.
    //   console.log(error)
    // }, (event) => {
    //   console.log(event)
    //   // Progress callback.
    //   // event.detail.progress contains a number between 1 and 100 as the upload progresses.
    // })

    // Upload multiple files:
    // @this.uploadMultiple('photos', [file], successCallback, errorCallback, progressCallback)

    // Remove single file from multiple uploaded files
    // @this.removeUpload('photos', uploadedFilename, successCallback)
  </script>
@endpush
