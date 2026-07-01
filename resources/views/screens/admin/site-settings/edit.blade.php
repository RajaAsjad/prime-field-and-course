@extends('layouts.admin.master')

@section('title', 'Site Settings')

@section('content')
  <style>
    .site-settings-preview { max-height: 80px; width: auto; }
    .site-settings-preview--favicon { max-height: 48px; max-width: 48px; }
  </style>

  <div class="container-fluid">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0 mt-2">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form action="{{ route('site-settings.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row g-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>General Settings</h5>
              <p class="text-muted mb-0 mt-1">Site name and footer text shown on the public website.</p>
            </div>
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label" for="site_name">Site Name</label>
                  <input
                    type="text"
                    class="form-control @error('site_name') is-invalid @enderror"
                    id="site_name"
                    name="site_name"
                    value="{{ old('site_name', $settings->site_name) }}"
                  />
                  @error('site_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="footer_copyright">Footer Copyright Text</label>
                  <input
                    type="text"
                    class="form-control @error('footer_copyright') is-invalid @enderror"
                    id="footer_copyright"
                    name="footer_copyright"
                    value="{{ old('footer_copyright', $settings->footer_copyright) }}"
                  />
                  @error('footer_copyright')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12">
                  <label class="form-label" for="footer_description">Footer Description</label>
                  <textarea
                    class="form-control @error('footer_description') is-invalid @enderror"
                    id="footer_description"
                    name="footer_description"
                    rows="3"
                  >{{ old('footer_description', $settings->footer_description) }}</textarea>
                  @error('footer_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Branding</h5>
              <p class="text-muted mb-0 mt-1">Upload logos and favicon. Max 5MB for logos, 2MB for favicon.</p>
            </div>
            <div class="card-body">
              <div class="row g-4">
                <div class="col-md-4">
                  <label class="form-label" for="site_logo">Header Logo</label>
                  @if ($settings->siteLogoUrl())
                    <div class="mb-2">
                      <p class="small text-muted mb-1">Current logo</p>
                      <img src="{{ $settings->siteLogoUrl() }}" alt="Current header logo" class="img-thumbnail site-settings-preview" id="current-site-logo">
                    </div>
                  @endif
                  <input
                    type="file"
                    class="form-control @error('site_logo') is-invalid @enderror"
                    id="site_logo"
                    name="site_logo"
                    accept=".png,.jpg,.jpeg,.webp,.svg,image/png,image/jpeg,image/webp,image/svg+xml"
                    data-preview="preview-site-logo"
                  />
                  <img src="#" alt="" class="img-thumbnail site-settings-preview mt-2 d-none" id="preview-site-logo">
                  @error('site_logo')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-4">
                  <label class="form-label" for="footer_logo">Footer Logo</label>
                  @if ($settings->footerLogoUrl())
                    <div class="mb-2">
                      <p class="small text-muted mb-1">Current logo</p>
                      <img src="{{ $settings->footerLogoUrl() }}" alt="Current footer logo" class="img-thumbnail site-settings-preview" id="current-footer-logo">
                    </div>
                  @endif
                  <input
                    type="file"
                    class="form-control @error('footer_logo') is-invalid @enderror"
                    id="footer_logo"
                    name="footer_logo"
                    accept=".png,.jpg,.jpeg,.webp,.svg,image/png,image/jpeg,image/webp,image/svg+xml"
                    data-preview="preview-footer-logo"
                  />
                  <img src="#" alt="" class="img-thumbnail site-settings-preview mt-2 d-none" id="preview-footer-logo">
                  @error('footer_logo')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-4">
                  <label class="form-label" for="favicon">Favicon</label>
                  @if ($settings->faviconUrl())
                    <div class="mb-2">
                      <p class="small text-muted mb-1">Current favicon</p>
                      <img src="{{ $settings->faviconUrl() }}" alt="Current favicon" class="img-thumbnail site-settings-preview site-settings-preview--favicon" id="current-favicon">
                    </div>
                  @endif
                  <input
                    type="file"
                    class="form-control @error('favicon') is-invalid @enderror"
                    id="favicon"
                    name="favicon"
                    accept=".ico,.png,.jpg,.jpeg,.svg,image/x-icon,image/png,image/jpeg,image/svg+xml"
                    data-preview="preview-favicon"
                  />
                  <img src="#" alt="" class="img-thumbnail site-settings-preview site-settings-preview--favicon mt-2 d-none" id="preview-favicon">
                  @error('favicon')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Contact Information</h5>
            </div>
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label" for="contact_email">Contact Email</label>
                  <input
                    type="email"
                    class="form-control @error('contact_email') is-invalid @enderror"
                    id="contact_email"
                    name="contact_email"
                    value="{{ old('contact_email', $settings->contact_email) }}"
                  />
                  @error('contact_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4">
                  <label class="form-label" for="contact_phone">Contact Phone</label>
                  <input
                    type="text"
                    class="form-control @error('contact_phone') is-invalid @enderror"
                    id="contact_phone"
                    name="contact_phone"
                    value="{{ old('contact_phone', $settings->contact_phone) }}"
                  />
                  @error('contact_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4">
                  <label class="form-label" for="address">Address</label>
                  <textarea
                    class="form-control @error('address') is-invalid @enderror"
                    id="address"
                    name="address"
                    rows="2"
                  >{{ old('address', $settings->address) }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Social Links</h5>
            </div>
            <div class="card-body">
              <div class="row g-3">
                @foreach ([
                  'facebook_url' => 'Facebook URL',
                  'instagram_url' => 'Instagram URL',
                  'linkedin_url' => 'LinkedIn URL',
                  'youtube_url' => 'YouTube URL',
                  'twitter_url' => 'Twitter / X URL',
                ] as $field => $label)
                  <div class="col-md-6">
                    <label class="form-label" for="{{ $field }}">{{ $label }}</label>
                    <input
                      type="url"
                      class="form-control @error($field) is-invalid @enderror"
                      id="{{ $field }}"
                      name="{{ $field }}"
                      value="{{ old($field, $settings->{$field}) }}"
                      placeholder="https://"
                    />
                    @error($field)
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    document.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
      input.addEventListener('change', function () {
        var previewId = input.getAttribute('data-preview');
        var preview = document.getElementById(previewId);
        if (!preview) return;

        if (!input.files || !input.files[0]) {
          preview.classList.add('d-none');
          preview.removeAttribute('src');
          return;
        }

        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('d-none');
      });
    });
  </script>
@endsection
