
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
        <form action="{{ Route('item.store') }}" method="post" enctype="multipart/form-data">
          @csrf
        <div class="row">
          <div class="col-sm-6">

            <div class="form-group">
              <label for="catId">Items Code</label>
              <input type="text" class="form-control" name="item_code" id="item_code" placeholder="Enter Items Code">
              <span class="text-danger">
                @error('catId')
                  {{ $message }}
                @enderror
              </span>
            </div>

          	 <div class="form-group">
              <label for="name">Item Name</label> 
              <input type="text" name="name" id="name" placeholder="Enter Items Name" class="form-control" value="{{ old('name') }}">
              <span class="text-danger">
                @error('name')
                  {{ $message }}
                @enderror
              </span>
             </div>

             <div class="form-group">
               <label for="des">Item Description</label>
               <textarea name="des" id="des" placeholder="Enter Item Description" class="form-control">{{ old('des') }}</textarea>

              <span class="text-danger">
                @error('des')
                  {{ $message }}
                @enderror
              </span>
             </div>

            </div>
            <div class="col-sm-6">
             <div class="form-group">
              <label for="pic">Sub Category Image</label> 
              <input type="file" name="pic" class="form-control">
              <span class="text-danger">
                @error('image')
                  {{ $message }}
                @enderror
              </span>
             </div>
             <div class="form-group">
              <label for="gallery">Sub Category Image</label> 
              <input type="file" name="gallery[]" class="form-control" multiple>
              <span class="text-danger">
                @error('image')
                  {{ $message }}
                @enderror
              </span>
             </div>
             <div class="form-group">
               <button class="form-control btn btn-info" >Add Product</button>
             </div>

            </div>
          </div><!-- col-3 -->
        </form>
      </div><!-- br-pagebody -->
@endsection