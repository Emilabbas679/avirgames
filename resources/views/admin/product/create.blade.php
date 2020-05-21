@extends('admin.layout')
@section('title', 'Create Product')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
        </div>
        <div class="card-body">
            <div class="col-md-8 mr-auto ml-auto">
                <form class="user" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills"
                             role="tabpanel" aria-labelledby="pills-tab">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input  id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="name"
                                            value="{{ old('name') }}" placeholder="Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input  id="img-1" type="file"
                                            class="form-control @error('img-1') is-invalid @enderror"
                                            name="img-1"
                                            value="{{ old('name') }}">
                                    <input  id="img-2" type="file"
                                            class="form-control @error('img-2') is-invalid @enderror"
                                            name="img-2"
                                            value="{{ old('img-2') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Platform</label>
                                <div class="col-sm-9">
                                    <select name="platform_id" class="form-control  @error('platform_id') is-invalid @enderror">
                                        <option value="0" selected>Select Platform</option>
                                        @foreach($platforms as $p)
                                            <option value="{{ $p->id }}" @if(old('platform_id') == $p->id) selected @endif>{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('platform_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control  @error('category_id') is-invalid @enderror">
                                            <option value="0" selected>Select category</option>
                                            @foreach($categories as $c)
                                                <option value="{{ $c->id }}"  @if(old('category_id') == $c->id) selected @endif>{{ $c->name }}</option>
                                            @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <select name="city_id" class="form-control  @error('city_id') is-invalid @enderror">
                                        <option value="0" selected>Select city</option>
                                        @foreach($cities as $c)
                                            <option value="{{ $c->id }}"  @if(old('city_id') == $c->id) selected @endif>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Condition</label>
                                <div class="col-sm-9">
                                    <select name="condition" class="form-control  @error('confition') is-invalid @enderror">
                                        <option value="0" selected>Select condition</option>
                                        <option value="new"  @if(old('condition') == 'new') selected @endif>New</option>
                                        <option value="old"  @if(old('condition') == 'old') selected @endif>Old</option>
                                    </select>
                                    @error('condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea  id="description" type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            name="description" > {{old('description')}} </textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="type[]" value="sell" class="type"> Sell
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="type[]" value="hire" class="type"> Hire
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="type[]" value="barter" class="type"> Barter
                                    </label>
                                </div>
                            </div>


                            <div class="form-group row" id="div-sell-price" style="display: none">
                                <label class="col-sm-3 col-form-label">Sell Price</label>
                                <div class="col-sm-9">
                                    <input  id="sell_price" type="number" step="0.01"
                                            class="form-control @error('sell_price') is-invalid @enderror"
                                            name="sell_price"
                                            value="{{ old('sell_price') }}" placeholder="Sell Price">
                                    @error('sell_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row" id="div-hire-period" style="display: none">
                                <label class="col-sm-3 col-form-label">Hire Period</label>
                                <div class="col-sm-9">
                                    <select name="hire_period_id" id="hire_period_id" class="form-control  @error('hire_period_id') is-invalid @enderror">
                                        <option value="0" selected>Select Period</option>
                                        @foreach($periods as $p)
                                            <option value="{{ $p->id }}"  @if(old('hire_period_id') == $p->id) selected @endif>{{ $p->count }} {{$p->period}}</option>
                                        @endforeach
                                    </select>
                                    @error('hire_period_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" id="div-hire-price" style="display: none">
                                <label class="col-sm-3 col-form-label">Hire Price</label>
                                <div class="col-sm-9">
                                    <input  id="hire_price" type="number"
                                            class="form-control @error('hire_price') is-invalid @enderror"
                                            name="hire_price"
                                            value="{{ old('hire_price') }}" placeholder="Hire price">
                                    @error('hire_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" id="div-hire-description" style="display: none">
                                <label class="col-sm-3 col-form-label">Hire Description</label>
                                <div class="col-sm-9">
                                    <input  id="hire_decriptions" type="text"
                                            class="form-control @error('hire_decriptions') is-invalid @enderror"
                                            name="hire_descriptions"
                                            value="{{ old('hire_descriptions') }}" placeholder="Hire decriptions">
                                    @error('hire_decriptions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row" id="div-barter-type" style="display: none">
                                <label class="col-sm-3 col-form-label">Barter type</label>
                                <div class="col-sm-9">
                                    <select name="barter_type" id="barter_type" class="form-control  @error('barter_type') is-invalid @enderror">
                                        <option value="0" selected>Select Barter type</option>
                                        <option value="equal">Equal</option>
                                        <option value="give">Give money on product</option>
                                        <option value="take">Take money on product</option>
                                    </select>
                                    @error('barter_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" id="div-barter-price" style="display: none">
                                <label class="col-sm-3 col-form-label">Barter Price</label>
                                <div class="col-sm-9">
                                    <input  id="barter_price" type="number"
                                            class="form-control @error('barter_price') is-invalid @enderror"
                                            name="barter_price"
                                            value="{{ old('barter_price') }}" placeholder="Barter Price">
                                    @error('barter_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="product-type" id="product-type">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>




@endsection

@section('js')

    <script>
        var type=[];
        var type_check=[];
        $('input[type="checkbox"]'). click(function() {
            $("input.type:checked").each(function(){
                type_check.push($(this).val());
            });
            type_check = type_check.filter(onlyUnique);
            if (type_check != type) {
                type = type_check
            }
            type_check = [];
            console.log(type);

            $('#product-type').val(type)
            if(type.indexOf("sell") !== -1){
                $("#div-sell-price").show();
            } else{
                $("#div-sell-price").hide();
                $("#sell_price").val('');
            }
            if(type.indexOf("hire") !== -1){
                $("#div-hire-description").show();
                $("#div-hire-period").show();
                $("#div-hire-price").show();
            } else{
                $("#div-hire-description").hide();
                $("#div-hire-period").hide();
                $("#div-hire-price").hide();
                $("#hire_period_id").val('0');
                $("#hire_price").val('');
                $("#hire_decriptions").val('');
            }
            if(type.indexOf("barter") !== -1){
                $("#div-barter-price").show();
                $("#div-barter-type").show();
            } else{
                $("#div-barter-price").hide();
                $("#div-barter-type").hide();
                $("#barter_type").val('0');
                $("#barter_price").val('');
            }
        });



        function onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        }
    </script>

    @endsection
