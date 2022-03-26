@extends('admin.admin_layouts')


@section('admin_content')

@php
    $blogpost = DB::table('posts')->get();
    $blogcategory = DB::table('post_category')->get();
@endphp
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Upstyle</a>
      <span class="breadcrumb-item active">Update Post Section</span>
    </nav>

    <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Post
            </h6>
  
            <form action="{{ url('update/blog/withoutimage/'.$blogpostEdit->id) }}" method="post">
                @csrf

            <div class="form-layout">
              <div class="row mg-b-25">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Post Title: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="post_title" value="{{ $blogpostEdit->post_title }}">
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                        <option label="Choose Category"></option>
                        @foreach ($blogcategory as $row)
                        <option value="{{ $row->id }}" <?php if($row->id == $blogpostEdit->category_id){
                            echo "selected"; } ?> >{{ $row->category_name }}</option> 
                        @endforeach
                        
                      </select>
                  </div>
                </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label">Post Details: <span class="tx-danger">*</span></label>
                      <textarea class="form-control" name="details" id="summernote">
                          {{ $blogpostEdit->details }}
                      </textarea>
                    </div>
                  </div><!-- col-4 -->



              </div> <!--row-->
              <br><br>
  
              <div class="form-layout-footer">
                <button class="btn btn-info mg-r-5" type="submit">Submit Form</button>
              </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
          </div><!-- card -->
        </form>

    </div><!--row-->

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Image
            </h6>
    
            <form action="{{ url('update/blog/image/'.$blogpostEdit->id) }}" method="post" enctype="multipart/form-data">
                @csrf
    
                <div class="row">
        <div class="col-lg-6 col-sm-6">
      
              <label class="form-control-label">Post Image: <span class="tx-danger">*</span></label><br>
              <label class="custom-file">
                  <input type="file" id="file" class="custom-file-input" name="post_image" onchange="readURL(this);">
                  <span class="custom-file-control"></span><br>
                  <input type="hidden" name="old_one" value="{{ $blogpostEdit->post_image }}">
                  <img src="#" id="one">
              </label>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <img src="{{ URL::to($blogpostEdit->post_image) }}" style="width: 80px; height: 80px;">
                </div>
          </div><!-- col-4 --><br><br>
    
                  <button type="submit" class="btn btn-sm btn-warning">Update Image</button>
        </form>
         
        </div></div>

     
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
