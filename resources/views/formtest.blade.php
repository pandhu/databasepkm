
<form action="{{url('pkm/add')}}" method="post" enctype="multipart/form-data">
    Judul:<br>
    <input type="text" name="title">
    <br>
    Leader:<br>
    <input type="text" name="leader">
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
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <br>
    Tahun:<br>
    <input type="text" name="year">
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
