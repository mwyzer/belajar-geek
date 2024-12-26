// Import React
import React, { useState } from 'react';

// Import layout
import LayoutAccount from '../../../../Layouts/Account';

// Import Inertia modules
import { Head, Link, useForm } from '@inertiajs/react';

export default function VoucherProfileCreate() {
    // Initialize Form State
    const { data, setData, post, errors } = useForm({
        profile_name: '',
        description: '',
        discount: '',
        status: 'inactive',
    });

    // Handle Submit
    function handleSubmit(e) {
        e.preventDefault();
        post('/account/vouchers');
    }

    return (
        <>
            <Head>
                <title>Create Voucher Profile - Geek Store</title>
            </Head>
            <LayoutAccount>
                {/* Header Section */}
                <div className="row mt-5">
                    <div className="col-md-8">
                        <h4>Create Voucher Profile</h4>
                    </div>
                    <div className="col-md-4 text-end">
                        <Link href="/account/vouchers" className="btn btn-secondary">
                            Back
                        </Link>
                    </div>
                </div>

                {/* Form Section */}
                <div className="card mt-3 border-0 rounded shadow-sm">
                    <div className="card-body">
                        <form onSubmit={handleSubmit}>
                            {/* Profile Name */}
                            <div className="mb-3">
                                <label className="form-label">Profile Name</label>
                                <input
                                    type="text"
                                    value={data.profile_name}
                                    onChange={(e) => setData('profile_name', e.target.value)}
                                    className="form-control"
                                />
                                {errors.profile_name && <div className="text-danger">{errors.profile_name}</div>}
                            </div>

                            {/* Description */}
                            <div className="mb-3">
                                <label className="form-label">Description</label>
                                <textarea
                                    value={data.description}
                                    onChange={(e) => setData('description', e.target.value)}
                                    className="form-control"
                                    rows="3"
                                ></textarea>
                                {errors.description && <div className="text-danger">{errors.description}</div>}
                            </div>

                            {/* Discount */}
                            <div className="mb-3">
                                <label className="form-label">Discount (%)</label>
                                <input
                                    type="number"
                                    value={data.discount}
                                    onChange={(e) => setData('discount', e.target.value)}
                                    className="form-control"
                                />
                                {errors.discount && <div className="text-danger">{errors.discount}</div>}
                            </div>

                            {/* Status */}
                            <div className="mb-3">
                                <label className="form-label">Status</label>
                                <select
                                    value={data.status}
                                    onChange={(e) => setData('status', e.target.value)}
                                    className="form-select"
                                >
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                {errors.status && <div className="text-danger">{errors.status}</div>}
                            </div>

                            {/* Submit Button */}
                            <div className="d-flex justify-content-end">
                                <button type="submit" className="btn btn-success">
                                    Save Voucher Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
