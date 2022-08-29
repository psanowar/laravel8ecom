
@extends('backend.master_template.template')

@section('content')
<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Blank Page</h4>
      <p class="mg-b-0">Page Description</p>
    </div>
</div>

      <div class="br-pagebody">
        <form action="{{ Route('item.update',$items->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
          <div class="col-sm-8">

              <div class="form-group">
                <label for="catId">Items Code</label>
                <input value="{{ $items->item_code }}" readonly type="text" class="form-control" name="item_code" id="item_code" placeholder="Enter Items Code">
                <span class="text-danger">
                  @error('catId')
                    {{ $message }}
                  @enderror
                </span>
              </div>

              <div class="form-group">
                <label for="name">Item Name</label> 
                <input type="text" name="name" id="name" placeholder="Enter Items Name" class="form-control" value="{{ $items->name }}">
                <span class="text-danger">
                  @error('name')
                    {{ $message }}
                  @enderror
                </span>
              </div>

              <div class="form-group">
                <label for="des">Item Description</label>
                <textarea name="des" id="des" placeholder="Enter Item Description" class="form-control">{{ $items->des }}</textarea>

                <span class="text-danger">
                  @error('des')
                    {{ $message }}
                  @enderror
                </span>
              </div>
              <div class="form-group">
                <img height="200" src="{{ asset('backend/items/'.$items->pic) }}" alt="">
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
            <div class="col-md-4">
              @foreach($gallery as $allpic)
              <form action="{{ Route('item.single.update',$allpic->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                  <a href="{{ Route('item.image.delete',$allpic->id) }}" class="btn btn-sm btn-danger" style="height:25px"><i class="fas fa-times"></i></a>
                  <img height="150" src="{{ asset('backend/items/gallery/'.$allpic->gallery) }}" alt="">
                  <input type="file" class="form-control" name="{{ $allpic->id }}">
                  <button>Update</button>
                </div>
              </form>
              @endforeach
            </div>
          </div><!-- col-3 -->
        </form>
      </div><!-- br-pagebody -->
@endsection