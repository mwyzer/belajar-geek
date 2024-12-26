import React from "react";
import { Head, usePage, Link, router } from '@inertiajs/react';
import LayoutAccount from '../../../../Layouts/Account';
import hasAnyPermission from '../../../../Utils/Permissions';
import Search from '../../../../Shared/Search';
import Pagination from '../../../../Shared/Pagination';

export default function VoucherProfilesIndex() {
    const { voucherProfiles } = usePage().props;

    function handleDelete(id) {
        if (confirm('Are you sure you want to delete this voucher profile?')) {
            router.delete(`/account/vouchers/${id}`);
        }
    }

    return (
        <>
            <Head>
                <title>Voucher Profiles - Geek Store</title>
            </Head>
            <LayoutAccount>
                {/* Header Section */}
                <div className="row mt-5">
                    <div className="col-md-8">
                        <div className="row">
                            <div className="col-md-3 col-12 mb-2">
                                {hasAnyPermission(['vouchers.create']) && (
                                    <Link 
                                        href="/account/vouchers/create" 
                                        className="btn btn-md btn-success border-0 shadow w-100"
                                        type="button"
                                    >
                                        <i className="fa fa-plus-circle me-2"></i>
                                        Add Voucher Profile
                                    </Link>
                                )}
                            </div>
                            <div className="col-md-9 col-12 mb-2">
                                <Search URL={'/account/vouchers'} />
                            </div>
                        </div>
                    </div>
                </div>

                {/* Table Section */}
                <div className="row mt-2 mb-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold">
                                    <i className="fa fa-voucher"></i> Voucher Profiles
                                </span>
                            </div>
                            <div className="card-body">
                                <div className="table-responsive">
                                    <table className="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col" style={{ width: '5%' }}>No.</th>
                                                <th scope="col" style={{ width: '20%' }}>Profile Name</th>
                                                <th scope="col" style={{ width: '10%' }}>Status</th>
                                                <th scope="col" style={{ width: '15%' }}>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {voucherProfiles.data.map((profile, index) => (
                                                <tr key={profile.id}>
                                                    <td className="text-center">
                                                        {index + 1 + (voucherProfiles.current_page - 1) * voucherProfiles.per_page}
                                                    </td>
                                                    <td>{profile.profile_name}</td>
                                                    <td>
                                                        {profile.status === 'active' ? (
                                                            <span className="badge bg-success">Active</span>
                                                        ) : (
                                                            <span className="badge bg-danger">Inactive</span>
                                                        )}
                                                    </td>
                                                    <td className="text-center">
                                                        {hasAnyPermission(['vouchers.edit']) && (
                                                            <Link 
                                                                href={`/account/vouchers/${profile.id}/edit`} 
                                                                className="btn btn-primary btn-sm me-2"
                                                            >
                                                                <i className="fa fa-pencil-alt"></i>
                                                            </Link>
                                                        )}
                                                        {hasAnyPermission(['voucher-profiles.delete']) && (
                                                            <button 
                                                                className="btn btn-danger btn-sm"
                                                                onClick={() => handleDelete(profile.id)}
                                                            >
                                                                <i className="fa fa-trash"></i>
                                                            </button>
                                                        )}
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>

                                {/* Pagination Component */}
                                <Pagination links={voucherProfiles.links} align={'end'} />
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
