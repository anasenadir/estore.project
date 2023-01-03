@extends('layouts.pdfTemplate')

@section('table')
        <thead>
          <tr>
            <th scope="col">Product Code</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Unit Total</th>
          </tr>
        </thead>
        <tbody>
          @if (isset($invoicedetails))
            @foreach ($invoicedetails as $seleDetail)
              <tr>
                <td style="text-align: center">{{$seleDetail->product->product_code}}</td>
                <td style="text-align: center">{{$seleDetail->quantity}}</td>
                <td style="text-align: center">{{$seleDetail->product_price}}</td>
                <td style="text-align: center">{{($seleDetail->product_price * $seleDetail->quantity)}}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
@endsection