@extends('admin.admin_layouts')

@section('admin_content')


<div class="sl-mainpanel">


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Subscribers List</h5>
      </div><!-- sl-page-title -->

      

      <div class="card pd-20 pd-sm-40">

        <form method="post" action="">
          @csrf
          @method('DELETE')
          <button fromaction="{{ route('deleteall') }}" type="sumbit" class="btn btn-danger">Delete All</button>

        <h6 class="card-body-title">Subscribers List
        </h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Email</th>
                <th class="wd-15p">Subscribing Time</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($sub as $key=>$row)
              <tr>
                <td><input type="checkbox" name="ids[]" value="{{ $row->id }}"> {{ $key +1 }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForhumans()  }}</td>
                <td>

                    <a href="{{ URL::to('delete/sub/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->


  </div><!-- sl-mainpanel -->
</form>

@endsection