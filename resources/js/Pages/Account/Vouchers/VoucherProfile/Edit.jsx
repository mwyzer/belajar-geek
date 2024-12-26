// Import React  
import React, { useState } from "react";

// Import layout  
import LayoutAccount from "../../../../Layouts/Account";

// Import Head, usePage, router, and Link  
import { Head, usePage, router, Link } from "@inertiajs/react";

// Import SweetAlert  
import Swal from "sweetalert2";

export default function Edit() {
    // Destructure props  
    const { voucherProfile, errors } = usePage().props;

    // State for form fields  
    const [profileName, setProfileName] = useState(voucherProfile.profile_name || "");
    const [description, setDescription] = useState(voucherProfile.description || "");
    const [discount, setDiscount] = useState(voucherProfile.discount || "");
    const [status, setStatus] = useState(voucherProfile.status || "inactive");

    // Handle form submission  
    const handleUpdate = (e) => {
        e.preventDefault();

        // Prepare data for submission  
        const data = {
            profile_name: profileName,
            description,
            discount,
            status,
            _method: "PUT", // Specify PUT for Laravel
        };

        // Send data via Inertia router  
        router.post(`/account/voucher-profiles/${voucherProfile.id}`, data, {
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Voucher Profile updated successfully!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            },
        });
    };

    return (
        <>
            <Head>
                <title>Edit Voucher Profile - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold">
                                    <i className="fa fa-edit"></i> Edit Voucher Profile
                                </span>
                            </div>
                            <div className="card-body">
                                <form onSubmit={handleUpdate}>
                                    {/* Profile Name */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Profile Name</label>
                                        <input
                                            type="text"
                                            value={profileName}
                                            onChange={(e) => setProfileName(e.target.value)}
                                            className="form-control"
                                        />
                                        {errors.profile_name && (
                                            <div className="alert alert-danger">{errors.profile_name}</div>
                                        )}
                                    </div>

                                    {/* Description */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Description</label>
                                        <textarea
                                            value={description}
                                            onChange={(e) => setDescription(e.target.value)}
                                            className="form-control"
                                            rows="3"
                                        ></textarea>
                                        {errors.description && (
                                            <div className="alert alert-danger">{errors.description}</div>
                                        )}
                                    </div>

                                    {/* Discount */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Discount (%)</label>
                                        <input
                                            type="number"
                                            value={discount}
                                            onChange={(e) => setDiscount(e.target.value)}
                                            className="form-control"
                                        />
                                        {errors.discount && (
                                            <div className="alert alert-danger">{errors.discount}</div>
                                        )}
                                    </div>

                                    {/* Status */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Status</label>
                                        <select
                                            value={status}
                                            onChange={(e) => setStatus(e.target.value)}
                                            className="form-select"
                                        >
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                        {errors.status && (
                                            <div className="alert alert-danger">{errors.status}</div>
                                        )}
                                    </div>

                                    {/* Actions */}
                                    <div>
                                        <button type="submit" className="btn btn-md btn-success me-2">
                                            <i className="fa fa-save"></i> Update
                                        </button>
                                        <Link href="/account/vouchers" className="btn btn-md btn-secondary">
                                            <i className="fa fa-arrow-left"></i> Back
                                        </Link>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
