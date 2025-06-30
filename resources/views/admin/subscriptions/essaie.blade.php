@extends('dashboard')
@section('title', 'Subscriptions')
@section('page-title', 'Subscriptions')
@section('extra-style')
<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>

@section('extra-style')

@endsection

@section('content')


 
    <button id="pay-btn">Payer 100 FCFA</button>
    <script type="text/javascript">
      FedaPay.init("#pay-btn", { public_key: "sk_sandbox_WHk3VWXx2OoC_xzCkpI8UCqg " });
    </script>


@endsection