// Import React  
import React, { useState } from 'react';

// Import layout
import LayoutAccount from '../../../Layouts/Account';

// Import Inertia modules
import { Head, Link, useForm } from '@inertiajs/react';

// Import permissions utility
import hasAnyPermission from '../../../Utils/Permissions';

export default function ProviderCreate({ locations }) {
    // Initialize Form State
    const { data, setData, post, errors, reset } = useForm({
        location_id: '',
        provider_type: '',
        numbers: '',
        provider_status: '',
        is_suk: false,
        k1h: '',
        pln_number: '',
        pln_name: '',
        wifi_private_pass: '',
        wifi_main_pass: '',
        status: 'inactive',
    });

    // Handle Submit
    function handleSubmit(e) {
        e.preventDefault();
        post('/account/providers');
    }

    return (
        <>
            <Head>
                <title>Create Provider - Geek Store</title>
            </Head>
            <LayoutAccount>
                {/* Header Section */}
                <div className="row mt-5">
                    <div className="col-md-8">
                        <h4>Create Provider</h4>
                    </div>
                    <div className="col-md-4 text-end">
                        <Link href="/account/providers" className="btn btn-secondary">
                            Back
                        </Link>
                    </div>
                </div>

                {/* Form Section */}
                <div className="card mt-3 border-0 rounded shadow-sm">
                    <div className="card-body">
                        <form onSubmit={handleSubmit}>
                            {/* Location */}
                            <div className="mb-3">
                                <label className="form-label">Location</label>
                                <select
                                    value={data.location_id}
                                    onChange={(e) => setData('location_id', e.target.value)}
                                    className="form-select"
                                >
                                    <option value="">-- Select Location --</option>
                                    {locations.map((location) => (
                                        <option key={location.id} value={location.id}>
                                            {location.name}
                                        </option>
                                    ))}
                                </select>
                                {errors.location_id && <div className="text-danger">{errors.location_id}</div>}
                            </div>

                            {/* Provider Type */}
                            <div className="mb-3">
                                <label className="form-label">Provider Type</label>
                                <input
                                    type="text"
                                    value={data.provider_type}
                                    onChange={(e) => setData('provider_type', e.target.value)}
                                    className="form-control"
                                />
                                {errors.provider_type && <div className="text-danger">{errors.provider_type}</div>}
                            </div>

                            {/* Numbers */}
                            <div className="mb-3">
                                <label className="form-label">Numbers (comma-separated)</label>
                                <input
                                    type="text"
                                    value={data.numbers}
                                    onChange={(e) => setData('numbers', e.target.value.split(','))}
                                    className="form-control"
                                />
                                {errors.numbers && <div className="text-danger">{errors.numbers}</div>}
                            </div>

                            {/* Provider Status */}
                            <div className="mb-3">
                                <label className="form-label">Provider Status</label>
                                <input
                                    type="text"
                                    value={data.provider_status}
                                    onChange={(e) => setData('provider_status', e.target.value)}
                                    className="form-control"
                                />
                                {errors.provider_status && <div className="text-danger">{errors.provider_status}</div>}
                            </div>

                            {/* Boolean Field: is_suk */}
                            <div className="mb-3 form-check">
                                <input
                                    type="checkbox"
                                    checked={data.is_suk}
                                    onChange={(e) => setData('is_suk', e.target.checked)}
                                    className="form-check-input"
                                    id="isSuk"
                                />
                                <label className="form-check-label" htmlFor="isSuk">Is SUK</label>
                            </div>

                            {/* Other Fields */}
                            <div className="mb-3">
                                <label className="form-label">K1H</label>
                                <input
                                    type="text"
                                    value={data.k1h}
                                    onChange={(e) => setData('k1h', e.target.value)}
                                    className="form-control"
                                />
                            </div>
                            <div className="mb-3">
                                <label className="form-label">PLN Number</label>
                                <input
                                    type="text"
                                    value={data.pln_number}
                                    onChange={(e) => setData('pln_number', e.target.value)}
                                    className="form-control"
                                />
                            </div>
                            <div className="mb-3">
                                <label className="form-label">PLN Name</label>
                                <input
                                    type="text"
                                    value={data.pln_name}
                                    onChange={(e) => setData('pln_name', e.target.value)}
                                    className="form-control"
                                />
                            </div>
                            <div className="mb-3">
                                <label className="form-label">WiFi Private Password</label>
                                <input
                                    type="text"
                                    value={data.wifi_private_pass}
                                    onChange={(e) => setData('wifi_private_pass', e.target.value)}
                                    className="form-control"
                                />
                            </div>
                            <div className="mb-3">
                                <label className="form-label">WiFi Main Password</label>
                                <input
                                    type="text"
                                    value={data.wifi_main_pass}
                                    onChange={(e) => setData('wifi_main_pass', e.target.value)}
                                    className="form-control"
                                />
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
                                    Save Provider
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
