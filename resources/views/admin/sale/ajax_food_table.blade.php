

<div class="cart-top">
  <div class="d-flex justify-content-between flex-wrap align-items-center mb-3 waiter_customer">
    <div class="select_dropdown w-50">
        <select class="form-control" name="waiter_id">
          <option value="0" selected>Waiter</option>
          @foreach ($waiter as $waiter)
          <option value="{{$waiter->id}}">{{$waiter->name}}</option>
              
          @endforeach
        </select>
    </div>
    <div class="select_dropdown w-50">
      <select class="form-control" name="customer_id">
        <option value="">Walk-in Customer  <strong></strong> </option>
        @foreach ($customer as $item)
          <option value="{{$item->id}}">{{$item->customer_name}}</option>
            
        @endforeach
      </select>
    </div> 
    <div class="d-flex mt-3 edit_flex">
      <button type="button" class="btn operation_button edit_btn" data-toggle="modal" data-target="#exampleModal15"><i class="fa-solid fa-pencil"></i>Edit</button>
    </div>
        {{-- <div class="quantity-bar"> <span class="input-group-btn">
          <button type="button" class="btn-number btn-minus"  data-type="minus" data-field="quant[2]"> <i class="fas fa-minus"></i> </button>
          </span>
          <input type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="100" placeholder="1">
          <span class="input-group-btn">
          <button type="button" class="btn-number btn-plus" data-type="plus" data-field="quant[2]"> <i class="fas fa-plus"></i> </button>
          </span> 
        </div> --}}
  </div> 
  <table class="cart_table">
    <thead>
      <tr>
        <th>SN</th>
        <th>Item</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody >
      <?php $total_amount = 0;
      $total_item = 0;
      ?>

      @foreach ($carts as $item)
        <tr>
          <td class="serial">{{$item->id}}</td>
          <td class="product_title">{{$item->item}}</td>
          <td class="product_price">Rs.{{$item->price}}</td>
          <td class="quantity">

            <div class="quantity-bar"> <span class="input-group-btn">
              <button type="button" class="btn-number btn-minus qtyMinus" onclick="qtyMinus(this.getAttribute('attr'))"  data-type="minus"  attr="{{$item->id}}"  cart-value="{{$item->quantity}}"> <i class="fas fa-minus"></i> </button>
              </span>
              <input type="text" name="quantity"id="quant-{{$item->id}}" class="form-control input-number" value="{{$item->quantity}}" min="1" max="100" placeholder="1">
              <span class="input-group-btn">
              <button type="button" class="btn-number btn-plus qtyPlus" onclick="qtyPlus(this.getAttribute('attr'))" data-type="plus" attr="{{$item->id}}"  cart-value="{{$item->quantity}}" data-field="quant-{{$item->id}}"> <i class="fas fa-plus"></i> </button>
              </span> </div></td>
          <td class="total-price">Rs.{{$item->price * $item->quantity}}</td>
          <td class="discount"><a href="#" onclick="deleteCartItem(this.getAttribute('cart_id'))" class="" cart_id="{{$item->id}}" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>

        </tr>
        <?php $total_amount= $total_amount + ($item->price* $item->quantity);
        $total_item = $total_item + $item->quantity;
                                    
        ?>
      @endforeach
    </tbody>
  </table>
</div>
<div class="cart-bottom d-flex">
  <div class="cart-overview flex-1 my-3">
    <h5>Cart Total</h5>
    <ul class="cart_listing">
      <li><span>Total item:</span> <strong> {{$total_item}} </strong></li>
      <li> <span>Subtotal</span> <strong>{{$total_amount}}</strong> </li>
      <?php
        $tax = 10;
        $total_amount = $total_amount+($total_amount*10/100);
      ?>
      <li><span>Discount:</span> <input type="text" name="discount" class="" autocomplete="off" onkeyup="discountFunction(this)"> <strong> </strong></li>
      <li><span>Tax:</span> <strong>10%  <input type="hidden" name="tax" id="tax" value="10%" autocomplete="off"></strong></li>
      <li> <span>Total Payable</span> <strong id="total_amount">{{$total_amount}}</strong> </li>
    </ul>
  </div>
  <div class="cart-overview flex-1 my-3">
<input type="hidden" name="subtotal" id="sub_total"  value="{{$total_amount}}">
  
<input type="hidden" name="total" id="grand_total"   value="{{$total_amount}}">
    <h5>Payment Method</h5>
      <label>
    <input type="radio" value="Bank transfer" name="payment" checked>
    <p>Direct Bank Transfer</p>
    </label>
    
    <label>
    
    <input type="radio" value="Cash Payment" name="payment">
    <p>Cash Payment</p>
    </label>
    
    <label>
    <input type="radio" value="paypal" name="payment">
    <p>Paypal</p>
    <fieldset class="paymenttypes">
      <a href="#"><img src="images/esewa.jpg" alt="" class=""></a>
    </fieldset>
    </label>
  </div>
</div>
<input type="submit" value="Place Oder" class="btn btn-primary">
 {{-- <button type="button" class="btn btn-primary order_btn operation_button operation_button_50" > <i class="fas fa-utensils"></i>Place Order</button> --}}
  
  <div class="modal fade" id="exampleModal10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="modal-body">
          <p>Do you want to Print Order?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
  