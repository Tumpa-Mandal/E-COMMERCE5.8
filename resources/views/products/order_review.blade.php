@extends('layouts.frontLayout.front_design')
@section('content')


<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Order Review</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="shopper-informations">
				<div class="row">
										
				</div>
			</div>

			<div class="row">
				@if(Session::has('flash_message_error'))
             
				  <div class="alert alert-danger alert-block">
				      <button type="button" class="close" data-dismiss="alert">×</button> 
				       <strong>{!! session('flash_message_error') !!}</strong>
				  </div> 

				  @endif 
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
						<h2>Billing Details</h2>
						<div class="form-group">
							{{ $userDetails->name }}
						</div>	
						<div class="form-group">	
							{{ $userDetails->address }}
						</div>
						<div class="form-group">	
							{{ $userDetails->city }}
						</div>
						<div class="form-group">	
							{{ $userDetails->state }}
						</div>
						<div class="form-group">	
							{{ $userDetails->country }}
						
						</div>
						<div class="form-group">	
							{{ $userDetails->pincode }}
						</div>
						<div class="form-group">	
							{{ $userDetails->mobile }}
						</div>
	
					</div>
				</div>
				<div class="col-sm-1">
					<h2></h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Shipping Details</h2>
						
						<div class="form-group">
							{{ $shippingDetails->name }}
						</div>	
						<div class="form-group">	
							{{ $shippingDetails->address }}
						</div>
						<div class="form-group">	
							{{ $shippingDetails->city }}
						</div>
						<div class="form-group">	
							{{ $shippingDetails->state}}
						</div>
						<div class="form-group">

							{{ $shippingDetails->country }}

						</div>
						<div class="form-group">	
							{{ $shippingDetails->pincode}}
						</div>
						<div class="form-group">	
							{{ $shippingDetails->mobile}}
						</div>
						
					</div>
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							
						</tr>
					</thead>
					<tbody>
						<?php $total_amount = 0; ?>
						@foreach($userCart as $cart)
							<tr>
								<td class="cart_product">
									<a href=""><img style="width: 130px;" src="{{ asset('images/backend_images/products/small/'.$cart->image) }}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{ $cart->product_name }}</a></h4>
									<p>Code: {{ $cart->product_code }} | {{ $cart->size }}</p>
								</td>
								<td class="cart_price">
									<p>BDT {{ $cart->price }}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										{{ $cart->quantity }}
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">BDT {{ $cart->price*$cart->quantity }}</p>
								</td>
								
							</tr>
							<?php $total_amount = $total_amount+($cart->price*$cart->quantity); ?>
						@endforeach

						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>BDT {{ $total_amount }}</td>
									</tr>
								
									<tr class="shipping-cost">
										<td>Shipping Cost (+)</td>
										<td>BDT 0</td>										
									</tr>
									<tr class="shipping-cost">
										<td>Discount Amount (-)</td>
										<td>
											@if(!empty(session::get('CouponAmount')))
												BDT {{ session::get('CouponAmount') }}
											@else
											BDT 0
											@endif
										</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>BDT {{ $grand_total = $total_amount - session::get('CouponAmount') }}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<form name="paymentForm" id="paymentForm" action="{{ url('/place-order') }}" method="post">{{ csrf_field() }}
				<input type="hidden" name="grand_total" value="{{ $grand_total }}">
				<div class="payment-options">
						<span>
							<label><strong>Select Payment Method:</strong></label>
						</span>
						@if($codpincodeCount>0)
						<span>
							<label><input type="radio" name="payment_method" id="COD" value="COD"><strong>COD</strong></label>
						</span>
						@endif
						@if($prepaidpincodeCount>0)
						<span>
							<label><input type="radio" name="payment_method" id="Paypal" value="Paypal"><strong>Paypal</strong></label>
						</span>
						@endif
						<span style="float: right;">
							<button type="submit" class="btn btn-default" class="check_out" onclick="return selectPaymentMethod();">Place Order</button>
						</span>
				</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

@endsection