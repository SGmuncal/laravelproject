@extends('layouts.adminnavbar')

@section('admin_content')
<div class="jumbotron">
    <div class="container">
    <h2 style="font-weight: 400;">Gallery Images Update</h2>
   
    @if (Session::has('message'))
        <li style="font-size:20px;">{!! session('message') !!}</li>
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
                @foreach($update_image as $get_gallery_images)
                <tr>
                    <td><img src="{{url('/storage/'.$get_gallery_images->image.'')}}" class="img-fluid" style="height:100px;"></td>
                    <td>
                        <a href="{{ url('get_gallery_image',$get_gallery_images->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>

                        <br><br>
                        
                        <!-- NEW UPDATE -->
                        <form action="/delete_gallery_image" method="get">
                            <a href="{{ url('delete_gallery_image',$get_gallery_images->id) }}" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></a>
                        </form>


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