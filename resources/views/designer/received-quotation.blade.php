@include('designer.include.header')
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
                                                    <th>Vendor</th>
                                                    <th>Vendor Name</th>
                                                    <th>Action</th>
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
                                                    <td>
                                                        <div class="btn_grp">
                                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#quotationModal{{ $quotation->id }}">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                            <!--<form action="" method="POST" style="display: inline;" class="ms-2">-->
                                                            <!--    @csrf-->
                                                            <!--    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button>-->
                                                            <!--</form>-->
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <div class="modal fade" id="quotationModal{{ $quotation->id }}" tabindex="-1" aria-labelledby="quotationModalLabel{{ $quotation->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <!-- <h5 class="modal-title" id="quotationModalLabel{{ $quotation->id }}">Quotation Details</h5> -->
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="connect_popup quot_frm-details px-4">
                                                                    <h3 id="quotationModalLabel{{ $quotation->id }}">Quotation Details</h3>
                                                                    <p>This information is from <strong>{{ $quotation->quotationUser->name ?? 'Unknown Vendor' }}</strong></p>

                                                                    <div class="quot_frm">
                                                                        <div class="frm_grp"><label>Request ID:</label> <p>{{ $quotation->quote_id }}</p></div>
                                                                        <div class="frm_grp"><label>Product Category:</label> <p>{{ $quotation->product_category }}</p></div>
                                                                        <div class="frm_grp"><label>Date of Request:</label> <p>{{ $quotation->created_at->format('d M Y') }}</p></div>
                                                                        <div class="frm_grp"><label>Vendor:</label> <p>{{ ucfirst($quotation->quotationUser->role ?? 'Unknown') }}</p></div>
                                                                        <div class="frm_grp"><label>Vendor Name:</label> <p>{{ $quotation->quotationUser->name ?? 'Unknown Vendor' }}</p></div>
                                                                        <div class="frm_grp"><label>Additional Request:</label> <p>{{ $quotation->additional_request ?? 'N/A' }}</p></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <button type="button" class="btn btnCancel text-white" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                <div class="modal-footer border-0 text-center pt-0">
                    <button type="button" class="btn btn-primary m-auto">Confirm and Pay</button>
                </div>
            </div>
        </div>
    </div>



@include('designer.include.footer')