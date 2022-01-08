@foreach($subcategories as $subcategory)
    <tr data-id="{{$subcategory->id}}" data-parent="{{$dataParent}}" data-level = "{{$dataLevel + 1}}">
        <td data-column="name">{{$subcategory->title}}</td>
    </tr>
    @if($subcategory->grandchildren->count() > 0)
        @include('admin.content.subcategory',['subcategories' => $subcategory->grandchildren, 'dataParent' => $subcategory->id, 'dataLevel' => $dataLevel ])
    @endif
@endforeach