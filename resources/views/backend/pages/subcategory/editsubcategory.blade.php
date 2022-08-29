
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
        <form action="{{ Route('subcategoryupdate',$subcategory->id) }}" method="post" enctype="multipart/form-data">
          @csrf
        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label for="catId">Select Category Name</label>
          <select name="catId" id="catId" class="form-control">
            <option value="">------Select Category Name-----</option>
            @foreach($catname as $catname)
            <option value="{{ $catname->id }}" @if($catname->id == $subcategory->catId) selected @endif> {{ $catname->name }}</option>
            @endforeach
          </select>
          <span class="text-danger">
            @error('catId')
              {{ $message }}
            @enderror
          </span>
        </div>

        <div class="form-group">
          <label for="name">Sub-Category Name</label> 
          <input value="{{ $subcategory->subcatName }}" type="text" name="name" id="name" placeholder="Enter Sub Category Name" class="form-control" value="{{ old('name') }}">
          <span class="text-danger">
            @error('name')
              {{ $message }}
            @enderror
          </span>
        </div>

        <div class="form-group">
          <label for="des">Product Description</label>
          <textarea name="des" id="des" placeholder="Enter Product Description" class="form-control">{{ old('des') }} {{ $subcategory->des }}</textarea>

          <span class="text-danger">
            @error('des')
              {{ $message }}
            @enderror
          </span>
        </div>

        </div>
        <div class="col-sm-6">

        <div class="form-group">
          <img src="{{ asset('backend/subcategoryimages/'.$subcategory->img) }}" height="150"/>
          <label for="image">Sub Category Image</label> 
          <input type="file" name="image" class="form-control">
          <span class="text-danger">
            @error('image')
              {{ $message }}
            @enderror
          </span>
        </div>

        <div class="form-group">
          <label for="status">Sub-Category Status</label>
          <select name="status" id="status" class="form-control">
            <option value="">-----Select Status-----</option>
            <option value="1" @if($subcategory->status==1) selected @endif >Active</option>
            <option value="2" @if($subcategory->status==2) selected @endif >Inactive</option>
          </select>
        </div>

        <div class="form-group">
          <button class="form-control btn btn-info" >Add Product</button>
        </div>

        </div>
        </form>
      </div><!-- br-pagebody -->
@endsection