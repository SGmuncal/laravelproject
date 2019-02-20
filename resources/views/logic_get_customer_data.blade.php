@if(Auth::user())
    @foreach($customer_details as $detail)
        <tr>
            <td>{{$detail->customer_name}}</td>
            <td>{{$detail->customer_address}}</td>
            <td>{{$detail->customer_email}}</td>
            <td>{{$detail->customer_number}}</td>
            <td>{{$detail->customer_location}}</td>
            <td>{!!$detail->customer_order_note!!}</td>
            <td>{{$detail->customer_registered}}</td>
            <td><button class="btn btn-primary" type="button" value="{{$detail->customer_id}}" data-toggle="modal" data-target="#add_cart" id="show_cart"><i class="fas fa-cart-arrow-down"></i></button></td>


        </tr>
    @endforeach
@endif
			        	