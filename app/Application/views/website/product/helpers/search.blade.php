<form action="{{ url('/search') }}" method="get">
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Search term...">
           <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
           </span>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="input-group pull-left">
                <select name="country" id="country" class="form-control">
                    <option value="">Select Your Country</option>
                    @foreach($country as $key => $value)
                        <option value="{{ $key }}">{{ getDefaultValueKey($value) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group pull-left" style="margin-left: 10px">
                <select name="state" id="state" class="form-control">
                    <option value="">Select Your State</option>
                </select>
            </div>



            <div class="input-group pull-left" style="margin-left: 10px">
                <select name="cat_id" id="" class="form-control">
                    <option value="">Select Your Cateqoury</option>
                    @foreach($cats as $key => $value)
                        <option value="{{ $key }}">{{ getDefaultValueKey($value) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group pull-left" style="margin-left: 10px">
                <input type="text" class="form-control" name="price" placeholder="Put Price">
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</form>
<br>
