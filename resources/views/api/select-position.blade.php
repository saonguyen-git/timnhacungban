@if(!empty($result))
    @if($type == 'area')
        <option value="no-data">Chọn Quận/Huyện</option>
    @endif
    @if($type == 'ward')
        <option value="no-data">Chọn Xã/Phường</option>
    @endif
    @foreach($result as $item)
        <option value="{{ $item->slug }}">{!! $item->name !!}</option>
    @endforeach
@endif