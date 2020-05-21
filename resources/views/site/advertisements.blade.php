@extends('site.layout')
@section('title', __('site.advertisements'))
@section('content')
    <style>
        .category__select{
            min-width: 150px;
        }
    </style>
    <main>
        <section>
            <div class="container">
                <div class="category__sortBox">
                    <h1 class="section__headering">OYUNLAR</h1>
                    <!-- Example single danger button -->
                    <div class="category__dropgGroup">
                        <div class="category__select">
                            <img src="/site/img/down-icon.png" alt="" class="category__select--icon">
                            <select class="category-genre  myDrop myDrop--2 " name="console">
                                <option value="0" selected>Bütün konsollar</option>
                                @foreach($platforms as $p)
                                <option value="{{$p->id}}">{{$p->name}}</option>
                                    @endforeach
                            </select>
                            <input type="hidden" value="" class="category-genre-hidden">
                        </div>
                        <div class="category__select">
                            <img src="/site/img/down-icon.png" alt="" class="category__select--icon">
                            <select class="category-platform  myDrop myDrop--2 " name="category">
                                <option value="0">Bütün kateqoriyalar</option>
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                            </select>
                            <input type="hidden" value="" class="category-platform-hidden">

                        </div>
                        <div class="category__select">
                            <img src="/site/img/down-icon.png" alt="" class="category__select--icon">
                            <select class="category-sort  myDrop myDrop--2 " name="filter">
                                <option value="0">{{__('site.filter')}}</option>
                                <option value="sell">{{__('site.sell')}}</option>
                                <option value="hire">{{__('site.hire')}}</option>
                                <option value="barter">{{__('site.barter')}}</option>
                            </select>
                            <input type="hidden" value="" class="category-sort-hidden">

                        </div>


                    </div>
                </div>
                <div id="products" class="mb-3">
                    @include('site.partials.products')
                </div>

            </div>
        </section>
    </main>

    @endsection


@push('scripts')

    <script>
        $(document).ready(function(){
            $("select").change(function(){
                var platform = $("select[name='console']").val();
                var category = $("select[name='category']").val();
                var filter = $("select[name='filter']").val();
                console.log(filter)
                $.ajax({
                    type:"POST",
                    data: { 'platform' : platform,
                            'category' : category,
                            'filter'   : filter,
                        "_token": "{{ csrf_token() }}",
                    },
                    url:'/site/filter-products',
                    success:function(response){
                        $("div#products").html(response)
                    }
                });
            });
        });
    </script>
    @endpush






