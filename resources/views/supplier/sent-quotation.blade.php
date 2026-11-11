@include('supplier.include.header')
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
                            <th>User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotations as $quotation)
                        
                        <tr>
                            <td>{{ $quotation->quote_id }}</td>
                            <td>{{ $quotation->product_category }}</td>
                            <td>{{ $quotation->expected_delivery_time }}</td>
                            <td>
                                @php
                                $designer = App\Models\User::where('id', $quotation->user_id)->first();
                                @endphp
                                @if($designer)
                                {{ $designer->name }}
                                @else
                                N/A
                                @endif
                            </td>
                           
                            <td>
                                <div class="btn_grp">
                                        @if($quotation->status == 0)
                                    <form action="{{ route('supplier.quotation.approve', $quotation) }}" method="POST" style="display:inline-block;" class="d-inline-flex align-items-center gap-2">
                                        @csrf
                                        <input type="number" step="0.01" min="0" name="amount" class="form-control" placeholder="Amount" style="width: 130px;" required>
                                        <button type="submit" class="badge text-bg-success border-0">Approved</button>
                                    </form>
                                        @else
                                        <span class="badge text-bg-success p-2" title="Order already Generated">Order Successfully Created</span>
                                    @endif
                                    <button type="button" class="btn viewQuotationBtn" data-bs-toggle="modal" data-bs-target="#exampleModalQuotation"
                                        data-name="{{ $quotation->name }}"
                                        data-email="{{ $quotation->email }}"
                                        data-phone="{{ $quotation->phone }}"
                                        data-address="{{ $quotation->delivery_address }}"
                                        data-product="{{ $quotation->product_category }}"
                                        data-leather="{{ $quotation->leather_category }}"
                                        data-units="{{ $quotation->units_of_product }}"
                                        data-delivery="{{ $quotation->expected_delivery_time }}"
                                        data-design="{{ $quotation->design_prototype ? asset($quotation->design_prototype) : '' }}"
                                        
                                        data-request="{{ $quotation->additional_request }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">                                                                    
                                                <path d="M17.3508 8.13861C17.564 8.37486 17.682 8.68179 17.682 9.00003C17.682 9.31828 17.564 9.62521 17.3508 9.86146C16.0008 11.3143 12.9279 14.1429 9.34076 14.1429C5.75362 14.1429 2.68076 11.3143 1.33076 9.86146C1.11754 9.62521 0.999512 9.31828 0.999512 9.00003C0.999512 8.68179 1.11754 8.37486 1.33076 8.13861C2.68076 6.68575 5.75362 3.85718 9.34076 3.85718C12.9279 3.85718 16.0008 6.68575 17.3508 8.13861Z" stroke="#1086B4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M9.57143 11.5714C10.9916 11.5714 12.1429 10.4202 12.1429 9.00002C12.1429 7.57986 10.9916 6.42859 9.57143 6.42859C8.15127 6.42859 7 7.57986 7 9.00002C7 10.4202 8.15127 11.5714 9.57143 11.5714Z" stroke="#1086B4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                                                    
                                        </svg>
                                    </button>
                                    <button class="btn Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path
                                                d="M5.25 15.75C4.8375 15.75 4.48425 15.603 4.19025 15.309C3.89625 15.015 3.7495 14.662 3.75 14.25V4.5H3V3H6.75V2.25H11.25V3H15V4.5H14.25V14.25C14.25 14.6625 14.103 15.0158 13.809 15.3098C13.515 15.6038 13.162 15.7505 12.75 15.75H5.25ZM12.75 4.5H5.25V14.25H12.75V4.5ZM6.75 12.75H8.25V6H6.75V12.75ZM9.75 12.75H11.25V6H9.75V12.75Z" fill="#F50000"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
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
    <div class="modal fade" id="exampleModalnewProject" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <form class="d-flex gap-2 flex-column">
                        <h5>Create a Project</h5>
                        <div class="input-group mb-3"><input type="text" name="projectName" class="form-control"
                                placeholder="Project Name" aria-label="Project Name"></div>
                        <div class="input-group mb-3"><input type="text" name="projectCategory" class="form-control"
                                placeholder="Category" aria-label="Category"></div><button
                            class="btn btnSubmit m-auto text-white w-auto">Submit</button>
                    </form>
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
                                placeholder="Alex Cooper" class="form-control" readonly></div>
                            <div class="frm_grp"><label for="email">Email ID</label><input type="text" name="email"
                                id="email" placeholder="alexcooper@gmail.com" class="form-control" readonly></div>
                            <div class="frm_grp"><label for="mobileNumber">Mobile Number</label><input type="text"
                                name="mobileNumber" id="mobileNumber" placeholder="8893xxxxxx" class="form-control" readonly>
                            </div>
                            <div class="frm_grp"><label for="deliveryAddress">Delivery Address</label><input type="text"
                                name="deliveryAddress" id="deliveryAddress"
                                placeholder="3645 Landon Street, Ontario" class="form-control" readonly></div>
                            <div class="frm_grp arrow_select"><label for="productCategory">Product
                                Category</label><select name="productCategory" id="productCategory"
                                class="form-control" disabled>
                                <option value="Bag">Bag</option>
                                <option value="Cloth">Cloth</option>
                                <option value="Bed">Bed</option>
                                </select></div>
                            <div class="frm_grp arrow_select"><label for="leatherCategory">Leather
                                Category</label><select name="leatherCategory" id="leatherCategory"
                                class="form-control" disabled>
                                <option value="split leather">Split Leather</option>
                                <option value="soft leather">soft Leather</option>
                                <option value="hard leather">hard Leather</option>
                                </select></div>
                            <div class="frm_grp"><label for="unitsOfProduct">Units of Product</label><input type="text"
                                name="unitsOfProduct" id="unitsOfProduct" placeholder="60" class="form-control" readonly>
                            </div>
                            <div class="frm_grp"><label for="expectedDeliveryTime">Expected Delivery time</label><input
                                type="text" name="expectedDeliveryTime" id="expectedDeliveryTime"
                                placeholder="Alex Cooper" class="form-control" readonly></div>
                            <div class="frm_grp"><label for="designPrototype">Design Prototype</label>
                                <div class="frm_grp">
    <a id="modal_design" href="#" target="_blank">View File</a>
</div>
                            </div>
                            <div class="frm_grp"><label for="additionalRequest">Additional Request</label><input
                                type="text" name="additionalRequest" id="additionalRequest" class="form-control" readonly>
                            </div>
                            </div>

                    </div>
                </div>
                <!--<div class="modal-footer border-0 text-center pt-0">-->
                <!--    <button type="button" class="btn btn-primary m-auto">Confirm and Pay</button>-->
                <!--</div>-->
            </div>
        </div>
    </div>



@include('supplier.include.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quotationModal = document.getElementById('exampleModalQuotation');
        if (!quotationModal) {
            return;
        }

        quotationModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            if (!button) {
                return;
            }

            var dataset = button.dataset;
            document.getElementById('name').value = dataset.name || '';
            document.getElementById('email').value = dataset.email || '';
            document.getElementById('mobileNumber').value = dataset.phone || '';
            document.getElementById('deliveryAddress').value = dataset.address || '';
            document.getElementById('productCategory').value = dataset.product || '';
            document.getElementById('leatherCategory').value = dataset.leather || '';
            document.getElementById('unitsOfProduct').value = dataset.units || '';
            document.getElementById('expectedDeliveryTime').value = dataset.delivery || '';
            document.getElementById('additionalRequest').value = dataset.request || '';

           var designLink = document.getElementById('modal_design');

if (dataset.design && dataset.design !== '') {
    designLink.href = dataset.design;
    designLink.target = "_blank";
    designLink.innerHTML = "View File";
    designLink.style.display = "inline-block";
} else {
    designLink.removeAttribute("href");
    designLink.innerHTML = "No File";
}
        });
    });
</script>