// Import React  
import React from "react";

// Import layout
import LayoutAccount from '../../../Layouts/Account';

// Import Inertia modules
import { Head, usePage, Link, router } from '@inertiajs/react';

// Import permissions utility
import hasAnyPermission from '../../../Utils/Permissions';

// Import shared components
import Search from '../../../Shared/Search';
import Pagination from '../../../Shared/Pagination';

export default function ProviderIndex() {
    // Destructure props "providers"
    const { providers } = usePage().props;

    // Handle Delete
    function handleDelete(id) {
        if (confirm('Are you sure you want to delete this provider?')) {
            router.delete(`/account/providers/${id}`);
        }
    }

    return (
        <>
            <Head>
                <title>Providers - Geek Store</title>
            </Head>
            <LayoutAccount>
                {/* Header Section */}
                <div className="row mt-5">
                    <div className="col-md-8">
                        <div className="row">
                            <div className="col-md-3 col-12 mb-2">
                                {hasAnyPermission(['providers.create']) && (
                                    <Link 
                                        href="/account/providers/create" 
                                        className="btn btn-md btn-success border-0 shadow w-100"
                                        type="button"
                                    >
                                        <i className="fa fa-plus-circle me-2"></i>
                                        Add Provider
                                    </Link>
                                )}
                            </div>
                            <div className="col-md-9 col-12 mb-2">
                                <Search URL={'/account/providers'} />
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
                                    <i className="fa fa-sitemap"></i> Providers
                                </span>
                            </div>
                            <div className="card-body">
                                <div className="table-responsive">
                                    <table className="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col" style={{ width: '5%' }}>No.</th>
                                                <th scope="col" style={{ width: '15%' }}>Location</th>
                                                <th scope="col" style={{ width: '15%' }}>Type</th>
                                                <th scope="col" style={{ width: '10%' }}>Status</th>
                                                <th scope="col" style={{ width: '25%' }}>Numbers</th>
                                                <th scope="col" style={{ width: '15%' }}>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {providers.data.map((provider, index) => (
                                                <tr key={provider.id}>
                                                    <td className="text-center">
                                                        {index + 1 + (providers.current_page - 1) * providers.per_page}
                                                    </td>
                                                    <td>{provider.location?.name || 'N/A'}</td>
                                                    <td>{provider.provider_type}</td>
                                                    <td>
                                                        {provider.status === 'active' ? (
                                                            <span className="badge bg-success">Active</span>
                                                        ) : (
                                                            <span className="badge bg-danger">Inactive</span>
                                                        )}
                                                    </td>
                                                    <td>
                                                        {provider.numbers?.join(', ') || 'N/A'}
                                                    </td>
                                                    <td className="text-center">
                                                        {hasAnyPermission(['providers.edit']) && (
                                                            <Link 
                                                                href={`/account/providers/${provider.id}/edit`} 
                                                                className="btn btn-primary btn-sm me-2"
                                                            >
                                                                <i className="fa fa-pencil-alt"></i>
                                                            </Link>
                                                        )}
                                                        {hasAnyPermission(['providers.delete']) && (
                                                            <button 
                                                                className="btn btn-danger btn-sm"
                                                                onClick={() => handleDelete(provider.id)}
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
                                <Pagination links={providers.links} align={'end'} />
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
