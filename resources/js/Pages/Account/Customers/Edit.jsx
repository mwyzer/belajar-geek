// Import React  
import React, { useState } from "react";

// Import Layout  
import LayoutAccount from '../../../Layouts/Account';

// Import Head, usePage, and router  
import { Head, usePage, router } from '@inertiajs/react';

// Import Sweet Alert  
import Swal from 'sweetalert2';

export default function CustomerEdit() {

    // Destructure props "errors" & "customer"  
    const { errors, customer } = usePage().props;

    // State management for customer fields  
    const [formData, setFormData] = useState({
        name: customer.name || '',
        whatsapp_number: customer.whatsapp_number || '',
        telegram_id: customer.telegram_id || '',
        account_type: customer.account_type || '',
        wa_plgn: customer.wa_plgn || '',
        total_deposit: customer.total_deposit || 0,
        registration_date: customer.registration_date || '',
        type: customer.type || '',
        ktp: customer.ktp || '',
        passport: customer.passport || '',
        membership_level: customer.membership_level || '',
        mitra_type: customer.mitra_type || ''
    });

    // Handle input changes  
    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value,
        });
    };

    // Method "updateCustomer"  
    const updateCustomer = async (e) => {
        e.preventDefault();

        // Sending data  
        router.post(`/account/customers/${customer.id}`, {
            ...formData,
            _method: "PUT",
        }, {
            onSuccess: () => {
                // Show success alert  
                Swal.fire({
                    title: 'Success!',
                    text: 'Customer data updated successfully!',
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
                <title>Edit Customer - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold"><i className="fa fa-user-edit"></i> Edit Customer</span>
                            </div>
                            <div className="card-body">
                                <form onSubmit={updateCustomer}>

                                    {/* Generic Fields */}
                                    {['name', 'whatsapp_number', 'telegram_id', 'account_type', 'wa_plgn', 'total_deposit', 'registration_date'].map((field) => (
                                        <div className="mb-3" key={field}>
                                            <label className="form-label fw-bold">{field.replace('_', ' ').toUpperCase()}</label>
                                            <input
                                                type={field === 'total_deposit' ? 'number' : field === 'registration_date' ? 'date' : 'text'}
                                                className="form-control"
                                                name={field}
                                                value={formData[field]}
                                                onChange={handleChange}
                                                placeholder={`Enter ${field.replace('_', ' ')}`}
                                            />
                                            {errors[field] && (
                                                <div className="alert alert-danger">{errors[field]}</div>
                                            )}
                                        </div>
                                    ))}

                                    {/* Conditional Fields Based on Type */}
                                    {formData.type === 'pelanggan' && (
                                        <>
                                            <div className="mb-3">
                                                <label className="form-label fw-bold">KTP</label>
                                                <input
                                                    type="text"
                                                    className="form-control"
                                                    name="ktp"
                                                    value={formData.ktp}
                                                    onChange={handleChange}
                                                    placeholder="Enter KTP"
                                                />
                                            </div>
                                            <div className="mb-3">
                                                <label className="form-label fw-bold">Passport</label>
                                                <input
                                                    type="text"
                                                    className="form-control"
                                                    name="passport"
                                                    value={formData.passport}
                                                    onChange={handleChange}
                                                    placeholder="Enter Passport"
                                                />
                                            </div>
                                        </>
                                    )}
                                    {formData.type === 'member' && (
                                        <div className="mb-3">
                                            <label className="form-label fw-bold">Membership Level</label>
                                            <input
                                                type="text"
                                                className="form-control"
                                                name="membership_level"
                                                value={formData.membership_level}
                                                onChange={handleChange}
                                                placeholder="Enter Membership Level"
                                            />
                                        </div>
                                    )}
                                    {formData.type === 'mitra' && (
                                        <div className="mb-3">
                                            <label className="form-label fw-bold">Mitra Type</label>
                                            <input
                                                type="text"
                                                className="form-control"
                                                name="mitra_type"
                                                value={formData.mitra_type}
                                                onChange={handleChange}
                                                placeholder="Enter Mitra Type"
                                            />
                                        </div>
                                    )}

                                    {/* Buttons */}
                                    <div>
                                        <button type="submit" className="btn btn-md btn-success me-2">
                                            <i className="fa fa-save"></i> Update
                                        </button>
                                        <button type="reset" className="btn btn-md btn-warning" onClick={() => setFormData({ ...customer })}>
                                            <i className="fa fa-redo"></i> Reset
                                        </button>
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
