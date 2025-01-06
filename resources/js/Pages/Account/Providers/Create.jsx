import React, { useState } from "react";
import LayoutAccount from '../../../Layouts/Account';
import { Head, usePage, router } from '@inertiajs/react';
import Swal from 'sweetalert2';

export default function ProviderCreate() {
    const { errors } = usePage().props;

    const [name, setName] = useState("");
    const [type, setType] = useState("");
    const [providerName, setProviderName] = useState("");
    const [number, setNumber] = useState("");
    const [position, setPosition] = useState("");
    const [owner, setOwner] = useState("");
    const [status, setStatus] = useState("active");
    const [loadBalance, setLoadBalance] = useState(false);

    const storeProvider = async (e) => {
        e.preventDefault();

        router.post('/account/providers', {
            name: name,
            type: type,
            provider: providerName,
            number: number,
            position: position,
            owner: owner,
            status: status,
            load_balance: loadBalance
        }, {
            onSuccess: () => {
                Swal.fire({
                    title: 'Success!',
                    text: 'Provider created successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    }

    return (
        <>
            <Head>
                <title>Create Provider - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold"><i className="fa fa-building"></i> Add New Provider</span>
                            </div>
                            <div className="card-body">
                                <form onSubmit={storeProvider}>
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Name</label>
                                        <input type="text" className="form-control" value={name} onChange={(e) => setName(e.target.value)} placeholder="Enter Provider Name" />
                                        {errors.name && (
                                            <div className="alert alert-danger">
                                                {errors.name}
                                            </div>
                                        )}
                                    </div>

                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Type</label>
                                        <input type="text" className="form-control" value={type} onChange={(e) => setType(e.target.value)} placeholder="Enter Provider Type" />
                                        {errors.type && (
                                            <div className="alert alert-danger">
                                                {errors.type}
                                            </div>
                                        )}
                                    </div>

                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Provider Name</label>
                                        <input type="text" className="form-control" value={providerName} onChange={(e) => setProviderName(e.target.value)} placeholder="Enter Provider Name" />
                                        {errors.provider && (
                                            <div className="alert alert-danger">
                                                {errors.provider}
                                            </div>
                                        )}
                                    </div>

                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Number</label>
                                        <input type="text" className="form-control" value={number} onChange={(e) => setNumber(e.target.value)} placeholder="Enter Number" />
                                        {errors.number && (
                                            <div className="alert alert-danger">
                                                {errors.number}
                                            </div>
                                        )}
                                    </div>

                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Position</label>
                                        <input type="text" className="form-control" value={position} onChange={(e) => setPosition(e.target.value)} placeholder="Enter Position" />
                                        {errors.position && (
                                            <div className="alert alert-danger">
                                                {errors.position}
                                            </div>
                                        )}
                                    </div>

                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Owner</label>
                                        <input type="text" className="form-control" value={owner} onChange={(e) => setOwner(e.target.value)} placeholder="Enter Owner" />
                                        {errors.owner && (
                                            <div className="alert alert-danger">
                                                {errors.owner}
                                            </div>
                                        )}
                                    </div>

                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Status</label>
                                        <select className="form-select" value={status} onChange={(e) => setStatus(e.target.value)}>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                        {errors.status && (
                                            <div className="alert alert-danger">
                                                {errors.status}
                                            </div>
                                        )}
                                    </div>

                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Load Balance</label>
                                        <select
                                            className="form-select"
                                            value={loadBalance.toString()}
                                            onChange={(e) => setLoadBalance(e.target.value === 'true')}
                                        >
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                        {errors.load_balance && (
                                            <div className="alert alert-danger">
                                                {errors.load_balance}
                                            </div>
                                        )}
                                    </div>

                                    <div>
                                        <button type="submit" className="btn btn-md btn-success me-2"><i className="fa fa-save"></i> Save</button>
                                        <button type="reset" className="btn btn-md btn-warning"><i className="fa fa-redo"></i> Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    )
}