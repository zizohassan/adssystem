@foreach($products as $product)
    <div class="col-sm-3">
        <article class="col-item">
            <div class="photo">
                <div class="options-cart-round">
                    <a href="{{ url('/product/'.$product->country->slug.'/'.$product->state->slug.'/'.$product->cat->slug.'/'.slug($product->name)) }}" class="btn btn-default" title="{{ $product->name  }}">
                        <span class="fa fa-shopping-cart"></span>
                    </a>
                </div>
                <a href="{{ url('/product/'.$product->country->slug.'/'.$product->state->slug.'/'.$product->cat->slug.'/'.slug($product->name)) }}" title="{{ $product->name  }}">
                    @if(json_decode($product->image))
                        <img src="{{ url(env('UPLOAD_PATH').'/'.json_decode($product->image)[0]) }}" class="img-responsive" alt="{{ $product->name  }}" />
                    @endif
                </a>
            </div>
            <div class="info">
                <div class="row">
                    <div class="price-details col-md-6">
                        <h2>
                            {{  str_limit($product->name , 12 , '..')  }}
                        </h2>
                        <span class="price-new">{{ $product->price }} $</span>
                        <span class="pull-left">
                           <span class="label label-warning "> {{ getDefaultValueKey($product->country->name) }}</span>
                            @if($viewStatus  != null)
                                <span class="label label-info " style="margin-right: 10px">{{ $product->status }}</span>
                            @endif
                        </span>

                    </div>
                </div>
            </div>
        </article>
    </div>
@endforeach