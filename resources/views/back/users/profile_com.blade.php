@extends('back.layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'User Manage')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-4">
        <!-- Browser Default -->
        <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <h5 class="card-header">Data Bengkel</h5>
            <div class="card-body">
            <form class="browser-default-validation">
                <div class="mb-3">
                <label class="form-label" for="basic-default-name">Nama Bengkel</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="basic-default-name" 
                    placeholder="John Doe" 
                    required=""
                >
                </div>

                <div class="mb-3">
                <label class="form-label" for="basic-default-name">Alamat Bengkel</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="basic-default-name" 
                    placeholder="John Doe" 
                    required=""
                >
                </div>

                <div class="mb-3">
                <label class="form-label" for="basic-default-name">Link Gmaps</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="basic-default-name" 
                    placeholder="John Doe" 
                    required=""
                >
                </div>
                
                <div class="mb-3">
                <label class="form-label" for="basic-default-dob">DOB</label>
                <input type="text" class="form-control flatpickr-validation flatpickr-input" id="basic-default-dob" required="">
                </div>

                <div class="col-12">
                    <div class="card">
                      <h5 class="card-header">Multiple</h5>
                      <div class="card-body">
                        <form action="/upload" class="dropzone needsclick dz-clickable" id="dropzone-multi">
                          <div class="dz-message needsclick">
                            Drop files here or click to upload
                            <span class="note needsclick">(This is just a demo dropzone. Selected files are
                              <span class="fw-medium">not</span> actually uploaded.)</span>
                          </div>
                          
                        </form>
                      </div>
                    </div>
                  </div>
                <div class="mb-3">
                <label class="form-label" for="basic-default-bio">Bio</label>
                <textarea class="form-control" id="basic-default-bio" name="basic-default-bio" rows="3" required=""></textarea>
                </div>
               
                <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                </div>
                </div>
            </form>
            </div>
        </div>
        </div>
        <!-- /Browser Default -->
    </div>
</div>
<script src="/asset/assets/vendor/libs/i18n/i18n.js"></script>
<script src="/asset/assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="/asset/assets/vendor/libs/dropzone/dropzone.js"></script>
<script src="/asset/assets/js/forms-file-upload.js"></script>
@endsection