@foreach($subcategories as $subcategory)
    <div class="ml-3 child-cats">
        <div class="custom-control custom-checkbox custom-control">
            <input name="category[]" type="checkbox" class="custom-control-input" id="category-{{$subcategory->id}}" value="{{$subcategory->id}}" {{ in_array($subcategory->id,$checked) ? "checked" : "" }}>
            <label class="custom-control-label" for="category-{{$subcategory->id}}">{{$subcategory->name}}</label>
        </div>
            @if(count($subcategory->subcategory))
                @include('product.subCategoryList',['subcategories' => $subcategory->subcategory,'checked'=>$checked])
            @endif
    </div>
@endforeach
