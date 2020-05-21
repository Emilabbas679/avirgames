@extends("admin.layout")
@section('title', 'product')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('product.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                All products</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>#</th>
                        <td>{{$product->id}}</td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td>{{$product->user->name}} {{$product->user->surname}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{!! $product->name !!}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{$product->slug}}</td>
                    </tr>
                    @if($images[0])
                        <tr>
                            <th>Images</th>
                            <td>
                                <img src="/uploads/products/{{$images[0]}}" alt="" width="60" height="60">
                                @if($images[1])
                                    <img src="/uploads/products/{{$images[1]}}" alt="" width="60" height="60">
                                @endif
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <th>Category</th>
                        <td>
                            @if($product->category_id !== 0 )
                                {{$product->category->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Platform</th>
                        <td>
                            @if($product->platform_id !== 0 )
                                {{$product->platform->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ads type</th>
                        <td>{{$product->ads_type}}</td>
                    </tr>
                    @if($product->ads_type == 'premium')
                    <tr>
                        <th>Deadline for premium</th>
                        <td>{{$product->premium_deadline}}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Condition</th>
                        <td>{{$product->condition}}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>
                            @if($product->city_id !== 0 )
                                {{$product->city->name}}
                                @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{!! $product->description !!}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{$product->type}}</td>
                    </tr>
                    <tr>
                        <th>Sell price</th>
                        <td>
                            @if($product->sell_price !== 0)
                                {{$product->sell_price}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Hire period</th>
                        <td>
                            @if($product->hire_period_id !==0)
                            {{$product->period->count}} {{$product->period->period}}
                                @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Hire price</th>
                        <td>{{$product->hire_price}}</td>
                    </tr>
                    <tr>
                        <th>Hire description</th>
                        <td>{{$product->hire_description}}</td>
                    </tr>
                    <tr>
                        <th>Barter type</th>
                        <td>{{$product->barter_type}}</td>
                    </tr>
                    <tr>
                        <th>Barter price</th>
                        <td>
                            @if($product->barter_money !== 0)
                                {{$product->barter_money}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{$product->status}}</td>
                    </tr>
                    <tr>
                        <th>Created by</th>
                        <td>
                            @if($product->created_by !== 0)
                                {{$product->createdBy->name}} {{$product->createdBy->surname}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Updated by</th>
                        <td>
                            @if($product->updated_by !== 0)
                                {{$product->updatedBy->name}} {{$product->updatedBy->surname}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{$product->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{$product->updated_at}}</td>
                    </tr>
                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('product.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


@endsection()
