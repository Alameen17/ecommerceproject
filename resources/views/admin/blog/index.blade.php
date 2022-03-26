@extends('admin.admin_layouts')

@section('admin_content')


<div class="sl-mainpanel">


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Blog Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Blog List
            <a href="{{ route('add.blogpost') }}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
        </h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">Post Category</th>
                <th class="wd-15p">Post Title</th>
                <th class="wd-15p">Post Image</th>
                <th class="wd-15p">Post Details</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($blogpost as $row)
              <tr>
                <td>{{ $row->category_name }}</td>
                <td>{{ $row->post_title }}</td>
                <td><img src="{{ URL::to($row->post_image) }}" alt="" height="50px;" width="50px;"></td>
                <td>{!! $row->details !!}</td>
                <td>
                    <a href="{{ URL::to('edit/blogpost/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ URL::to('delete/blogpost/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete">Delete</a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->


  </div><!-- sl-mainpanel -->


@endsection