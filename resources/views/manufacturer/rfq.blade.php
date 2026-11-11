@include('manufacturer.include.header')
                        <div class="content-wrapper">
                            <div class="dashboard_inner">
                                <div class="heading_bx">
                                    <h3>RFQ >> Raised RFQ</h3>
                                </div>
                                <div class="task_frm form_table">
                                    <div class="tabel_scoller">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Request ID</th>
                                                    <th>Product Name</th>
                                                    <th>Date of Request</th>
                                                    <th>Vendor</th>
                                                    <th>Vendor Name</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($quotations as $quotation)
                                                <tr>
                                                    <td>{{ $quotation->quote_id }}</td>
                                                    <td>{{ $quotation->product_category }}</td>
                                                    <td>{{ $quotation->created_at->format('d M Y') }}</td>
                                                    <td>{{ ucfirst($quotation->quotationUser->role ?? 'Unknown') }}</td>
                                                    <td>{{ $quotation->quotationUser->name ?? 'Unknown Vendor' }}</td>
                                                    <!-- {<td>
                                                        <div class="btn_grp">
                                                            <button class="btn" data-bs-toggle="modal" data-bs-target="#quotationModal{{ $quotation->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">                                                                    
                                                                    <path d="M17.3508 8.13861C17.564 8.37486 17.682 8.68179 17.682 9.00003C17.682 9.31828 17.564 9.62521 17.3508 9.86146C16.0008 11.3143 12.9279 14.1429 9.34076 14.1429C5.75362 14.1429 2.68076 11.3143 1.33076 9.86146C1.11754 9.62521 0.999512 9.31828 0.999512 9.00003C0.999512 8.68179 1.11754 8.37486 1.33076 8.13861C2.68076 6.68575 5.75362 3.85718 9.34076 3.85718C12.9279 3.85718 16.0008 6.68575 17.3508 8.13861Z" stroke="#1086B4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M9.57143 11.5714C10.9916 11.5714 12.1429 10.4202 12.1429 9.00002C12.1429 7.57986 10.9916 6.42859 9.57143 6.42859C8.15127 6.42859 7 7.57986 7 9.00002C7 10.4202 8.15127 11.5714 9.57143 11.5714Z" stroke="#1086B4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                                                    
                                                                </svg>
                                                            </button>
                                                            <form action="" method="POST" style="display: inline;" class="ms-2">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>} -->
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No quotations received yet.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <div class="modal fade" id="exampleModalQuotation" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="connect_popup px-5">
                        <h3>Request for Quotation</h3>
                        <p>This information will be shared with the Manufacturer</p>
                        <div class="quot_frm">
                            <div class="frm_grp"><label for="name">Name</label><input type="text" name="name" id="name"
                                    placeholder="Alex Cooper" class="form-control"></div>
                            <div class="frm_grp"><label for="email">Email ID</label><input type="text" name="email"
                                    id="email" placeholder="alexcooper@gmail.com" class="form-control"></div>
                            <div class="frm_grp"><label for="mobileNumber">Mobile Number</label><input type="text"
                                    name="mobileNumber" id="mobileNumber" placeholder="8893xxxxxx" class="form-control">
                            </div>
                            <div class="frm_grp"><label for="deliveryAddress">Delivery Address</label><input type="text"
                                    name="deliveryAddress" id="deliveryAddress"
                                    placeholder="3645 Landon Street, Ontario" class="form-control"></div>
                            <div class="frm_grp arrow_select"><label for="productCategory">Product
                                    Category</label><select name="productCategory" id="productCategory"
                                    class="form-control">
                                    <option value="Bag">Bag</option>
                                    <option value="Cloth">Cloth</option>
                                    <option value="Bed">Bed</option>
                                </select></div>
                            <div class="frm_grp arrow_select"><label for="leatherCategory">Leather
                                    Category</label><select name="leatherCategory" id="leatherCategory"
                                    class="form-control">
                                    <option value="splitleather">Split Leather</option>
                                    <option value="softleather">soft Leather</option>
                                    <option value="hardleather">hard Leather</option>
                                </select></div>
                            <div class="frm_grp"><label for="unitsOfProduct">Units of Product</label><input type="text"
                                    name="unitsOfProduct" id="unitsOfProduct" placeholder="60" class="form-control">
                            </div>
                            <div class="frm_grp"><label for="expectedDeliveryTime">Expected Delivery time</label><input
                                    type="text" name="expectedDeliveryTime" id="expectedDeliveryTime"
                                    placeholder="Alex Cooper" class="form-control"></div>
                            <div class="frm_grp"><label for="designPrototype">Design Prototype</label>
                                <div class="frm_upload"><a href="#">Request.pdf</a>
                                    <div class="upload_bx"><input type="file" class="form-control" placeholder="Request"
                                            id="Upload" name="designPrototype"><label for="Upload"
                                            class="Verified_btn">Upload</label></div>
                                </div>
                            </div>
                            <div class="frm_grp"><label for="additionalRequest">Additional Request</label><input
                                    type="text" name="additionalRequest" id="additionalRequest" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btnCancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
document.querySelectorAll('.viewQuotationBtn').forEach(button => {

    button.addEventListener('click', function(){

        document.getElementById('modal_name').value = this.dataset.name;
        document.getElementById('modal_email').value = this.dataset.email;
        document.getElementById('modal_phone').value = this.dataset.phone;
        document.getElementById('modal_address').value = this.dataset.address;
        document.getElementById('modal_product').value = this.dataset.product;
        document.getElementById('modal_leather').value = this.dataset.leather;
        document.getElementById('modal_units').value = this.dataset.units;
        document.getElementById('modal_delivery').value = this.dataset.delivery;
        document.getElementById('modal_request').value = this.dataset.request;


        if(this.dataset.design){
            document.getElementById('modal_design').href = this.dataset.design;
            document.getElementById('modal_design').innerHTML = "View Design";
        }else{
            document.getElementById('modal_design').href = "#";
            document.getElementById('modal_design').innerHTML = "No File";
        }

    });

});
</script>

@include('manufacturer.include.footer')