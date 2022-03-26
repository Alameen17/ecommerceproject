@extends('admin.admin_layouts')


@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Upstyle</a>
      <span class="breadcrumb-item active">Post Section</span>
    </nav>

    <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Add New Post
                <a href="{{ route('all.blogpost') }}" class="btn btn-success btn-sm pull-right">All Posts</a>
            </h6>
            <p class="mg-b-20 mg-sm-b-30">Add New Form</p>
  
            <form action="{{ route('store.post') }}" method="post" enctype="multipart/form-data">
                @csrf

            <div class="form-layout">
              <div class="row mg-b-25">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Post Title: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="post_title" placeholder="Enter Post Title">
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                        <option label="Choose Category"></option>
                        @foreach ($blogcategory as $row)
                        <option value="{{ $row->id }}">{{ $row->category_name }}</option> 
                        @endforeach
                        
                      </select>
                  </div>
                </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label">Post Details: <span class="tx-danger">*</span></label>
                      <textarea class="form-control" name="details" id="summernote"></textarea>
                    </div>
                  </div><!-- col-4 -->


                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Image One ( Main Thumbnail ): <span class="tx-danger">*</span></label>
                      <label class="custom-file">
                          <input type="file" id="file" class="custom-file-input" name="post_image" onchange="readURL(this);" required="">
                          <span class="custom-file-control"></span><br>
                          <img src="#" id="one">
                      </label>
                    </div>
                  </div><!-- col-4 -->
                  
                  
              </div><!-- row -->


              </div> <!--row-->
              <br><br>
  
              <div class="form-layout-footer">
                <button class="btn btn-info mg-r-5" type="submit">Submit Form</button>
              </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
          </div><!-- card -->
        </form>

    </div><!--row-->

     
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>


<script type="text/javascript">
    function readURL(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#one')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

  
@endsection
