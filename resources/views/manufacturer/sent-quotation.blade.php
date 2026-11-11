@include('manufacturer.include.header')
                        <div class="content-wrapper">
                            <div class="dashboard_inner">
                                <div class="heading_bx">
                                    <h3>RFQ >> Received Quotation</h3>
                                </div>
                                <div class="task_frm form_table">
                                    <div class="tabel_scoller">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Request ID</th>
                                                    <th>Product Name</th>
                                                    <th>Date of Request</th>
                                                    <th>Designer</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $quotations = \App\Models\Quotation::where('quotation_id', auth()->id())->orderByDesc('id')->get();
                                                @endphp
                                                @forelse($quotations as $quotation)
                                                <tr>
                                                    <td>{{ $quotation->quote_id }}</td>
                                                    <td>{{ $quotation->product_category }}</td>
                                                    <td>{{ $quotation->expected_delivery_time }}</td>
                                                    <td>
                                                        @php $designer = \App\Models\User::find($quotation->user_id); @endphp
                                                        {{ $designer?->name ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <div class="btn_grp">
                                                            @if($quotation->status == 0)
                                                            <form action="{{ route('manufacturer.quotation.approve', $quotation) }}" method="POST" style="display:inline-block;" class="d-inline-flex align-items-center gap-2">
                                                                @csrf
                                                                <input type="number" step="0.01" min="0" name="amount" class="form-control" placeholder="Amount" style="width: 130px;" required>
                                                                <button type="submit" class="badge text-bg-success border-0">Approved</button>
                                                            </form>
                                                            @else
                                                                <span class="badge text-bg-success p-2" title="Order already Generated">Order Successfully Created</span>
                                                            @endif
                                                          <button type="button" 
    class="btn viewQuotationBtn"
    data-bs-toggle="modal"
    data-bs-target="#exampleModalQuotation"
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
    
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18">
        <path d="M9 3C5 3 2 9 2 9s3 6 7 6 7-6 7-6-3-6-7-6z" 
        stroke="#1086B4" fill="none"/>
    </svg>

</button>
                                                            <button class="btn Delete">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                                    <path d="M5.25 15.75C4.8375 15.75 4.48425 15.603 4.19025 15.309C3.89625 15.015 3.7495 14.662 3.75 14.25V4.5H3V3H6.75V2.25H11.25V3H15V4.5H14.25V14.25C14.25 14.6625 14.103 15.0158 13.809 15.3098C13.515 15.6038 13.162 15.7505 12.75 15.75H5.25ZM12.75 4.5H5.25V14.25H12.75V4.5ZM6.75 12.75H8.25V6H6.75V12.75ZM9.75 12.75H11.25V6H9.75V12.75Z" fill="#F50000"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5">No quotations found.</td>
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
                            <div class="frm_grp">
    <label>Name</label>
    <p id="modal_name">-</p>
</div>

<div class="frm_grp">
    <label>Email ID</label>
    <p id="modal_email">-</p>
</div>

<div class="frm_grp">
    <label>Mobile Number</label>
    <p id="modal_phone">-</p>
</div>

<div class="frm_grp">
    <label>Delivery Address</label>
    <p id="modal_address">-</p>
</div>

<div class="frm_grp">
    <label>Product Category</label>
    <p id="modal_product">-</p>
</div>

<div class="frm_grp">
    <label>Leather Category</label>
    <p id="modal_leather">-</p>
</div>

<div class="frm_grp">
    <label>Units of Product</label>
    <p id="modal_units">-</p>
</div>

<div class="frm_grp">
    <label>Expected Delivery Time</label>
    <p id="modal_delivery">-</p>
</div>

<div class="frm_grp">
    <label>Design Prototype</label>
    <a id="modal_design" href="#" target="_blank">View File</a>
</div>

<div class="frm_grp">
    <label>Additional Request</label>
    <p id="modal_request">-</p>
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





@include('manufacturer.include.footer')

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
            document.getElementById('modal_name').innerText = dataset.name || '-';
            document.getElementById('modal_email').innerText = dataset.email || '-';
            document.getElementById('modal_phone').innerText = dataset.phone || '-';
            document.getElementById('modal_address').innerText = dataset.address || '-';
            document.getElementById('modal_product').innerText = dataset.product || '-';
            document.getElementById('modal_leather').innerText = dataset.leather || '-';
            document.getElementById('modal_units').innerText = dataset.units || '-';
            document.getElementById('modal_delivery').innerText = dataset.delivery || '-';
            document.getElementById('modal_request').innerText = dataset.request || '-';

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