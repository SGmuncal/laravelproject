@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
    <div class="container">
    <h2 style="font-weight: 400;">News Images Update</h2>
    
    @if (Session::has('message'))
        <li style="font-size:20px; color:red;">{!! session('message') !!}</li>
   @endif
   <br><br>
    <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($update_images as $get_news_images)
                <tr>
                    <td><img src="{{url('/storage/'.$get_news_images->file.'')}}" class="image-fluid" style="height:250px;"></td>
                    <td>
                        <a href="{{ url('get_news_image',$get_news_images->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
</div>
<br><br><br><br>
@endsection