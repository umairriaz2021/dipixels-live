<div id="ss" class="d-flex w-100">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-auto" data-toggle="modal" data-target="#exampleModal">
Pay Now
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 col-12 d-block">
                <div class="mess w-100 py-3">

                </div>
                <input type="hidden" name="order_id" id="order_id" value="11225">
                <div class="form-group">
                    <label for="card_holder_name">Card Holder Name</label>
                    <input type="text" class="form-control rounded-0" id="card_holder_name" name="card_holder_name" placeholder="Enter card holder name">
                    <div class="error_name py-2"></div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-12 col-12 d-block">
                <div class="form-group">
                    <label for="card_holder_name">Email</label>
                    <input type="email" class="form-control rounded-0" id="card_holder_email" name="card_holder_email" placeholder="Enter card holder email">
                    <div class="error_email py-2"></div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-12 col-12 d-block">
                <div class="form-group">
                    <label for="card_holder_name">Card Number</label>
                    <input type="number" class="form-control rounded-0" id="card_number" name="card_number" placeholder="Enter card holder email">
                    <div class="error_number py-2"></div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12 col-12 d-block">
                <div class="form-group">
                    <label for="card_expiry">Expiry Month / Year</label>
                    <div class="d-flex flex-row">
                    <select name="month" id="month"
                            class="form-control rounded-0 w-25">
                            <option value="08">08</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <select name="year" id="year"
                            class="form-control rounded-0 w-25 ml-3">
                            <option value="18">2018</option>
                            <option value="19">2019</option>
                            <option value="20">2020</option>
                            <option value="21">2021</option>
                            <option value="22">2022</option>
                            <option value="23">2023</option>
                            <option value="24">2024</option>
                            <option value="25">2025</option>
                            <option value="26">2026</option>
                            <option value="27">2027</option>
                            <option value="28">2028</option>
                            <option value="29">2029</option>
                            <option value="30">2030</option>
                        </select>
                        
            </div>
           
                    </div>
                   
                 
            </div>
            <div class="col-md-4 col-sm-12 col-12 d-block">
            <label for="cvc_card">CVC</label>
            <input type="number" name="cvc_card"  id="cvc_card" class="form-control rounded-0 w-50">
            <div class="error_cvc py-2"></div>    
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-attr="<?php echo $attr['appid']; ?>" id="paynow_stripe">Pay Now</button>
      </div>
    </div>
  </div>
</div>
</div>