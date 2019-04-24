@extends('layouts.adminnavbar')

@section('admin_content')

<div class="jumbotron" style="background-color:white;">
    <div class="container">
        <h2 style="font-weight: 400;">Mails</h2>
        <br><br>
        <div class="table-responsive">
        <table id="tables" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr style="font-size:14px;">
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
                    <tr style="font-size:14px;">
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
                        <td><a href="{{ url('mailfrom',$mail->id) }}" id="main_email_button" class="btn btn-primary"><i class="fab fa-readme"></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

<br><br><br><br>
@endsection