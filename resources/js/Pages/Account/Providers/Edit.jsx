// Import React  
import React, { useState } from "react";

// Import layout  
import LayoutAccount from '../../../Layouts/Account';

// Import Head, usePage, router, and Link  
import { Head, usePage, router, Link } from '@inertiajs/react';

// Import SweetAlert  
import Swal from 'sweetalert2';

export default function Edit() {
    // Destructure props  
    const { provider, locations, errors } = usePage().props;

    // State for form fields  
    const [locationId, setLocationId] = useState(provider.location_id || '');
    const [providerType, setProviderType] = useState(provider.provider_type || '');
    const [numbers, setNumbers] = useState(provider.numbers.join(',') || '');
    const [providerStatus, setProviderStatus] = useState(provider.provider_status || '');
    const [isSuk, setIsSuk] = useState(provider.is_suk || false);
    const [k1h, setK1h] = useState(provider.k1h || '');
    const [plnNumber, setPlnNumber] = useState(provider.pln_number || '');
    const [plnName, setPlnName] = useState(provider.pln_name || '');
    const [wifiPrivatePass, setWifiPrivatePass] = useState(provider.wifi_private_pass || '');
    const [wifiMainPass, setWifiMainPass] = useState(provider.wifi_main_pass || '');
    const [status, setStatus] = useState(provider.status || 'inactive');

    // Handle form submission  
    const handleUpdate = (e) => {
        e.preventDefault();

        // Prepare data for submission  
        const data = {
            location_id: locationId,
            provider_type: providerType,
            numbers: numbers.split(','),
            provider_status: providerStatus,
            is_suk: isSuk,
            k1h,
            pln_number: plnNumber,
            pln_name: plnName,
            wifi_private_pass: wifiPrivatePass,
            wifi_main_pass: wifiMainPass,
            status,
            _method: 'PUT', // Specify PUT for Laravel
        };

        // Send data via Inertia router  
        router.post(`/account/providers/${provider.id}`, data, {
            onSuccess: () => {
                Swal.fire({
                    title: 'Success!',
                    text: 'Provider updated successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    };

    return (
        <>
            <Head>
                <title>Edit Provider - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold">
                                    <i className="fa fa-edit"></i> Edit Provider
                                </span>
                            </div>
                            <div className="card-body">
                                <form onSubmit={handleUpdate}>
                                    {/* Location */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Location</label>
                                        <select
                                            value={locationId}
                                            onChange={(e) => setLocationId(e.target.value)}
                                            className="form-select"
                                        >
                                            <option value="">-- Select Location --</option>
                                            {locations.map((location) => (
                                                <option key={location.id} value={location.id}>
                                                    {location.name}
                                                </option>
                                            ))}
                                        </select>
                                        {errors.location_id && (
                                            <div className="alert alert-danger">{errors.location_id}</div>
                                        )}
                                    </div>

                                    {/* Provider Type */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Provider Type</label>
                                        <input
                                            type="text"
                                            value={providerType}
                                            onChange={(e) => setProviderType(e.target.value)}
                                            className="form-control"
                                        />
                                        {errors.provider_type && (
                                            <div className="alert alert-danger">{errors.provider_type}</div>
                                        )}
                                    </div>

                                    {/* Numbers */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Numbers (comma-separated)</label>
                                        <input
                                            type="text"
                                            value={numbers}
                                            onChange={(e) => setNumbers(e.target.value)}
                                            className="form-control"
                                        />
                                        {errors.numbers && (
                                            <div className="alert alert-danger">{errors.numbers}</div>
                                        )}
                                    </div>

                                    {/* Provider Status */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Provider Status</label>
                                        <input
                                            type="text"
                                            value={providerStatus}
                                            onChange={(e) => setProviderStatus(e.target.value)}
                                            className="form-control"
                                        />
                                        {errors.provider_status && (
                                            <div className="alert alert-danger">{errors.provider_status}</div>
                                        )}
                                    </div>

                                    {/* Boolean Field: is_suk */}
                                    <div className="mb-3 form-check">
                                        <input
                                            type="checkbox"
                                            checked={isSuk}
                                            onChange={(e) => setIsSuk(e.target.checked)}
                                            className="form-check-input"
                                            id="isSuk"
                                        />
                                        <label className="form-check-label" htmlFor="isSuk">
                                            Is SUK
                                        </label>
                                    </div>

                                    {/* K1H */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">K1H</label>
                                        <input
                                            type="text"
                                            value={k1h}
                                            onChange={(e) => setK1h(e.target.value)}
                                            className="form-control"
                                        />
                                    </div>

                                    {/* PLN Number */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">PLN Number</label>
                                        <input
                                            type="text"
                                            value={plnNumber}
                                            onChange={(e) => setPlnNumber(e.target.value)}
                                            className="form-control"
                                        />
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
                                    </div>

                                    {/* Actions */}
                                    <div>
                                        <button type="submit" className="btn btn-md btn-success me-2">
                                            <i className="fa fa-save"></i> Update
                                        </button>
                                        <Link href="/account/providers" className="btn btn-md btn-secondary">
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
