// Import React  
import React, { useState } from "react";

// Import Layout  
import LayoutAccount from '../../../Layouts/Account';

// Import Head, usePage, and router  
import { Head, usePage, router } from '@inertiajs/react';

// Import Sweet Alert  
import Swal from 'sweetalert2';

export default function CustomerCreate() {

    // Destructure props "errors"  
    const { errors } = usePage().props;

    // State management for customer fields  
    const [name, setName] = useState("");
    const [whatsapp_number, setWhatsappNumber] = useState("");
    const [telegram_id, setTelegramId] = useState("");
    const [account_type, setAccountType] = useState("");
    const [wa_plgn, setWaPlgn] = useState("");
    const [total_deposit, setTotalDeposit] = useState("");
    const [registration_date, setRegistrationDate] = useState("");

    // Method "storeCustomer"  
    const storeCustomer = async (e) => {
        e.preventDefault();

        // Sending data  
        router.post('/account/customers', {
            name,
            whatsapp_number,
            telegram_id,
            account_type,
            wa_plgn,
            total_deposit,
            registration_date,
        }, {
            onSuccess: () => {
                // Show success alert  
                Swal.fire({
                    title: 'Success!',
                    text: 'Customer data saved successfully!',
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
                <title>Create Customer - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold"><i className="fa fa-user-plus"></i> Add New Customer</span>
                            </div>
                            <div className="card-body">
                                <form onSubmit={storeCustomer}>

                                    {/* Name Field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Name</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            value={name}
                                            onChange={(e) => setName(e.target.value)}
                                            placeholder="Enter Customer Name"
                                        />
                                    </div>
                                    {errors.name && (
                                        <div className="alert alert-danger">{errors.name}</div>
                                    )}

                                    {/* WhatsApp Number Field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">WhatsApp Number</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            value={whatsapp_number}
                                            onChange={(e) => setWhatsappNumber(e.target.value)}
                                            placeholder="Enter WhatsApp Number"
                                        />
                                    </div>
                                    {errors.whatsapp_number && (
                                        <div className="alert alert-danger">{errors.whatsapp_number}</div>
                                    )}

                                    {/* Telegram ID Field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Telegram ID</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            value={telegram_id}
                                            onChange={(e) => setTelegramId(e.target.value)}
                                            placeholder="Enter Telegram ID"
                                        />
                                    </div>
                                    {errors.telegram_id && (
                                        <div className="alert alert-danger">{errors.telegram_id}</div>
                                    )}

                                    {/* Account Type Field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Account Type</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            value={account_type}
                                            onChange={(e) => setAccountType(e.target.value)}
                                            placeholder="Enter Account Type"
                                        />
                                    </div>
                                    {errors.account_type && (
                                        <div className="alert alert-danger">{errors.account_type}</div>
                                    )}

                                    {/* WA PLGN Field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">WA PLGN</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            value={wa_plgn}
                                            onChange={(e) => setWaPlgn(e.target.value)}
                                            placeholder="Enter WA PLGN"
                                        />
                                    </div>
                                    {errors.wa_plgn && (
                                        <div className="alert alert-danger">{errors.wa_plgn}</div>
                                    )}

                                    {/* Total Deposit Field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Total Deposit</label>
                                        <input
                                            type="number"
                                            className="form-control"
                                            value={total_deposit}
                                            onChange={(e) => setTotalDeposit(e.target.value)}
                                            placeholder="Enter Total Deposit"
                                        />
                                    </div>
                                    {errors.total_deposit && (
                                        <div className="alert alert-danger">{errors.total_deposit}</div>
                                    )}

                                    {/* Registration Date Field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Registration Date</label>
                                        <input
                                            type="date"
                                            className="form-control"
                                            value={registration_date}
                                            onChange={(e) => setRegistrationDate(e.target.value)}
                                            placeholder="Select Registration Date"
                                        />
                                    </div>
                                    {errors.registration_date && (
                                        <div className="alert alert-danger">{errors.registration_date}</div>
                                    )}

                                    {/* Buttons */}
                                    <div>
                                        <button type="submit" className="btn btn-md btn-success me-2">
                                            <i className="fa fa-save"></i> Save
                                        </button>
                                        <button type="reset" className="btn btn-md btn-warning">
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
