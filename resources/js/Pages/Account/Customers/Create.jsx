// Import React
import React, { useState } from "react";

// Import Layout
import LayoutAccount from '../../../Layouts/Account';

// Import Head, Link, Inertia Form
import { Head, Link, useForm } from '@inertiajs/react';

export default function CreateCustomer() {
    // Set up form with Inertia's useForm
    const { data, setData, post, processing, errors } = useForm({
        name: "",
        whatsapp_number: "",
        telegram_id: "",
        account_type: "",
        wa_plgn: "",
        total_deposit: 0,
        type: "",
        ktp: "",
        passport: "",
        membership_level: "",
        mitra_type: ""
    });

    // Handle form submission
    const handleSubmit = (e) => {
        e.preventDefault();
        post('/account/customers');
    };

    return (
        <>
            <Head>
                <title>Create Customer - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-5">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold"><i className="fa fa-user-plus"></i> Add New Customer</span>
                            </div>
                            <div className="card-body">
                                <form onSubmit={handleSubmit}>
                                    <div className="row">
                                        <div className="col-md-6 mb-3">
                                            <label className="form-label">Name</label>
                                            <input
                                                type="text"
                                                className={`form-control ${errors.name ? 'is-invalid' : ''}`}
                                                value={data.name}
                                                onChange={(e) => setData('name', e.target.value)}
                                            />
                                            {errors.name && <div className="invalid-feedback">{errors.name}</div>}
                                        </div>
                                        <div className="col-md-6 mb-3">
                                            <label className="form-label">WhatsApp Number</label>
                                            <input
                                                type="text"
                                                className={`form-control ${errors.whatsapp_number ? 'is-invalid' : ''}`}
                                                value={data.whatsapp_number}
                                                onChange={(e) => setData('whatsapp_number', e.target.value)}
                                            />
                                            {errors.whatsapp_number && <div className="invalid-feedback">{errors.whatsapp_number}</div>}
                                        </div>
                                        <div className="col-md-6 mb-3">
                                            <label className="form-label">Telegram ID</label>
                                            <input
                                                type="text"
                                                className={`form-control ${errors.telegram_id ? 'is-invalid' : ''}`}
                                                value={data.telegram_id}
                                                onChange={(e) => setData('telegram_id', e.target.value)}
                                            />
                                            {errors.telegram_id && <div className="invalid-feedback">{errors.telegram_id}</div>}
                                        </div>
                                        <div className="col-md-6 mb-3">
                                            <label className="form-label">Account Type</label>
                                            <select
                                                className={`form-control ${errors.account_type ? 'is-invalid' : ''}`}
                                                value={data.account_type}
                                                onChange={(e) => setData('account_type', e.target.value)}
                                            >
                                                <option value="">Select Account Type</option>
                                                <option value="pelanggan">Pelanggan</option>
                                                <option value="member">Member</option>
                                                <option value="mitra">Mitra</option>
                                            </select>
                                            {errors.account_type && <div className="invalid-feedback">{errors.account_type}</div>}
                                        </div>
                                        <div className="col-md-6 mb-3">
                                            <label className="form-label">WA PLGN</label>
                                            <input
                                                type="text"
                                                className={`form-control ${errors.wa_plgn ? 'is-invalid' : ''}`}
                                                value={data.wa_plgn}
                                                onChange={(e) => setData('wa_plgn', e.target.value)}
                                            />
                                            {errors.wa_plgn && <div className="invalid-feedback">{errors.wa_plgn}</div>}
                                        </div>
                                        <div className="col-md-6 mb-3">
                                            <label className="form-label">Total Deposit</label>
                                            <input
                                                type="number"
                                                className={`form-control ${errors.total_deposit ? 'is-invalid' : ''}`}
                                                value={data.total_deposit}
                                                onChange={(e) => setData('total_deposit', e.target.value)}
                                            />
                                            {errors.total_deposit && <div className="invalid-feedback">{errors.total_deposit}</div>}
                                        </div>
                                    </div>
                                    {/* Conditional Fields */}
                                    {data.account_type === "pelanggan" && (
                                        <div className="row">
                                            <div className="col-md-6 mb-3">
                                                <label className="form-label">KTP</label>
                                                <input
                                                    type="text"
                                                    className={`form-control ${errors.ktp ? 'is-invalid' : ''}`}
                                                    value={data.ktp}
                                                    onChange={(e) => setData('ktp', e.target.value)}
                                                />
                                                {errors.ktp && <div className="invalid-feedback">{errors.ktp}</div>}
                                            </div>
                                            <div className="col-md-6 mb-3">
                                                <label className="form-label">Passport</label>
                                                <input
                                                    type="text"
                                                    className={`form-control ${errors.passport ? 'is-invalid' : ''}`}
                                                    value={data.passport}
                                                    onChange={(e) => setData('passport', e.target.value)}
                                                />
                                                {errors.passport && <div className="invalid-feedback">{errors.passport}</div>}
                                            </div>
                                        </div>
                                    )}
                                    {data.account_type === "member" && (
                                        <div className="col-md-6 mb-3">
                                            <label className="form-label">Membership Level</label>
                                            <input
                                                type="text"
                                                className={`form-control ${errors.membership_level ? 'is-invalid' : ''}`}
                                                value={data.membership_level}
                                                onChange={(e) => setData('membership_level', e.target.value)}
                                            />
                                            {errors.membership_level && <div className="invalid-feedback">{errors.membership_level}</div>}
                                        </div>
                                    )}
                                    {data.account_type === "mitra" && (
                                        <div className="col-md-6 mb-3">
                                            <label className="form-label">Mitra Type</label>
                                            <input
                                                type="text"
                                                className={`form-control ${errors.mitra_type ? 'is-invalid' : ''}`}
                                                value={data.mitra_type}
                                                onChange={(e) => setData('mitra_type', e.target.value)}
                                            />
                                            {errors.mitra_type && <div className="invalid-feedback">{errors.mitra_type}</div>}
                                        </div>
                                    )}
                                    <div className="mt-4">
                                        <button type="submit" className="btn btn-success" disabled={processing}>
                                            <i className="fa fa-save me-2"></i> Save
                                        </button>
                                        <Link href="/account/customers" className="btn btn-secondary ms-2">
                                            <i className="fa fa-arrow-left me-2"></i> Back
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
