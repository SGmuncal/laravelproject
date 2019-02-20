@extends('layouts.adminnavbar')

@section('admin_content')

<div class="jumbotron">
    <div class="container">
        <h2 style="font-weight: 400;">Mails</h2>
        <br><br>
        <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Store Number</th>
                    <th scope="col">Transaction Number</th>
                    <th scope="col">Date of transaction</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($getmail as $mail)
                    <tr>
                        <td>{{$mail->firstname}} {{$mail->lastname}}</td>
                        <td>{{$mail->subject}}</td>
                        <td>
                             {!!
                                str_limit($mail->email, $limit = 10, $end = '...')
                            !!}
                        </td>
                        <td>{{$mail->contact}}</td>
                        <td>{{$mail->store_number}}</td>
                        <td>{{$mail->transaction_number}}</td>
                        <td>{{$mail->transaction_date}}</td>
                        <td>{{$mail->status}}</td>
                        <td><a href="{{ url('mailfrom',$mail->id) }}"><i class="fab fa-readme"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

<br><br><br><br>
@endsection