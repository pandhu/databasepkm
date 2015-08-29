
<form action="{{url('pkm/edit')}}" method="post" enctype="multipart/form-data">
    Judul:<br>
    <input type="text" value="{{$pkm->title}}" name="title">
    <br>
    Leader:<br>
    <input type="text" name="leader" value="{{$pkm->leader}}">
    <br>
    Fakultas:<br>
    <select name="faculty">
        @foreach($faculties as $faculty)
            <option value="{{$faculty->id}}">{{$faculty->name}}</option>
        @endforeach
    </select>
    <br>
    Category:
    <br>
    <select name="category">
        @foreach($categories as $category)
            <option @if($pkm->category == $category->id) {{'selected'}}@endif value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <br>
    Tahun:<br>
    <input type="text" name="year" value="{{$pkm->year}}">
    <br>
    Status:<br>
    <select name="status">
        @for($i = 0; $i < 4; $i++)
            <option value="{{$i}}">{{$status[$i]}}</option>
        @endfor
    </select>

    <br>
    File:<br>
    <input type="file" name="file" id="fileToUpload"> <br>
    <input type="hidden" value="{{csrf_token()}}" name="_token">
    <input type="submit" value="submit" name="submit">
    <br>
    {!! csrf_field() !!}
</form>
