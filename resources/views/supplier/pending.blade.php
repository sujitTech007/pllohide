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
                                                    <th>Designer</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>R281</td>
                                                    <td>Cuir Handbag</td>
                                                    <td>13 Apr 2024</td>
                                                    <td>Alex Cooper</td>
                                                    <td>
                                                        <div class="btn_grp">
                                                            <button class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalQuotation">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>

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

@include('supplier.include.footer')