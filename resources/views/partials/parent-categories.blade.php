@foreach($parentCategories as $category)
    <div class="custom-control custom-checkbox custom-control">
        <input name="category[]" type="checkbox" class="custom-control-input" id="category-{{$category->id}}" value="{{$category->id}}" {{ in_array($category->id,$checked) ? "checked" : "" }}>
        <label class="custom-control-label" for="category-{{$category->id}}">{{$category->name}}</label>
    </div>

    @if(count($category->subcategory))
        @include('partials.child-categories',['subcategories' => $category->subcategory,'checked'=>$checked])
    @endif

@endforeach
