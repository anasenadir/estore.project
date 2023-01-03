
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
        @foreach ($invoicedetails as $PricingDetail)
            <td style="text-align: center">{{$PricingDetail->product->product_code}}</td>
            <td style="text-align: center">{{$PricingDetail->quantity}}</td>
            <td style="text-align: center">{{$PricingDetail->product_price}}</td>
            <td style="text-align: center">{{($PricingDetail->product_price * $PricingDetail->quantity)}}</td>
        @endforeach
      @endif
  </tbody>
@endsection
