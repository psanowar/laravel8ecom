
@extends('backend.master_template.template')

@section('content')
<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Blank Page</h4>
      <p class="mg-b-0">DPage Description</p>
    </div>
</div>

      <div class="br-pagebody">
        <div class="row">
          <div class="col-md-12">
          	 <table class="table">
              <thead>
                <tr>
                  <th>#sl</th>
                  <th>Sub-Category Name</th>
                  <th>Category Name</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead> 

              <tbody>
                @php $sl=1 @endphp
                @foreach ($subcategory as $data)
                  <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ $data->catId }}</td>
                    <td>{{ $data->subcatName }}</td>
                    <td>{{ $data->des }}</td>
                    <td><img height="80" src="{{ asset('backend/subcategoryimages/'.$data->img)  }}" /></td>
                    <td>
                      @if ($data->status==1)
                      <span class="badge badge-info">Active</span>
                      @else
                      <span class="badge badge-warning">Inactive</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ Route('subcategoryedit', $data->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                      <button class="btn btn-sm btn-danger"><i class="fa fa-trash" data-target='#delete{{ $data->id }}' data-toggle="modal"></i></button>
                    </td>
                  </tr>
                  <!-- Modal -->
<div class="modal fade" id="delete{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to delete this product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{  Route('subcategorydelete', $data->id) }}" class="btn btn-danger">Confirm</a>
      </div>
    </div>
  </div>
</div>
                   @php $sl++ @endphp
                @endforeach
              </tbody>

             </table> 
            </div>
          </div><!-- col-3 -->
      </div><!-- br-pagebody -->
@endsection