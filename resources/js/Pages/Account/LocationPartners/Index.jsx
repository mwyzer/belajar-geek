import React, { useState } from "react";
import LayoutAccount from '../../../Layouts/Account';
import { Head, usePage, Link, router } from '@inertiajs/react';
import hasAnyPermission from '../../../Utils/Permissions';
import Search from '../../../Shared/Search';
import Pagination from '../../../Shared/Pagination';
import Sidebar2 from '../../../Components/Sidebar2';
import NewLayout from "../../../Layouts/Account2";

export default function LocationPartnerIndex() {
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const { locationPartners } = usePage().props;

    const toggleSidebar = () => {
        setSidebarOpen(!sidebarOpen);
    };

    const handleDelete = (id) => {
        if (confirm('Are you sure you want to delete this location partner?')) {
            router.delete(`/account/location-partners/${id}`);
        }
    };

    return (
        <>
            <Head>
                <title>Location Partners - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="d-flex">
                    {/* Sidebar for Desktop */}
                    <div className="sidebar-nav d-none d-md-block" style={{
                        width: '250px',
                        minHeight: '100vh',
                        borderRight: '1px solid #dee2e6'
                    }}>
                        <NewLayout />
                    </div>

                    {/* Sidebar for Mobile */}
                    <div className={`position-fixed sidebar-nav d-md-none ${sidebarOpen ? 'd-block' : 'd-none'}`} style={{
                        width: '250px',
                        minHeight: '100vh',
                        borderRight: '1px solid #dee2e6',
                        zIndex: 1000
                    }}>
                        <Sidebar2 />
                    </div>

                    {/* Main Content */}
                    <div className="flex-grow-1 p-4">
                        {/* Sidebar Toggle Button */}
                        <button 
                            className="btn btn-primary d-md-none mb-3" 
                            onClick={toggleSidebar}
                        >
                            <i className={`fa fa-${sidebarOpen ? 'times' : 'bars'}`}></i>
                        </button>

                        {/* Header Actions */}
                        <div className="row mt-5">
                            <div className="col-md-8">
                                <div className="row">
                                    <div className="col-md-3 col-12 mb-2">
                                        <Link 
                                            href="/account/location-partners/create" 
                                            className="btn btn-md btn-success border-0 shadow w-100"
                                            type="button"
                                        >
                                            <i className="fa fa-plus-circle me-2"></i>
                                            Add Partner
                                        </Link>
                                    </div>
                                    <div className="col-md-9 col-12 mb-2">
                                        <Search URL={'/account/location-partners'} />
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
                                            <i className="fa fa-handshake"></i> Location Partners
                                        </span>
                                    </div>
                                    <div className="card-body">
                                        <div className="table-responsive">
                                            <table className="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style={{ width: '5%' }}>No.</th>
                                                        <th scope="col" style={{ width: '20%' }}>Partner Name</th>
                                                        <th scope="col" style={{ width: '20%' }}>Location</th>
                                                        <th scope="col" style={{ width: '20%' }}>Contact</th>
                                                        <th scope="col" style={{ width: '15%' }}>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {locationPartners.data.map((partner, index) => (
                                                        <tr key={partner.id}>
                                                            <td className="text-center">
                                                                {index + 1 + (locationPartners.current_page - 1) * locationPartners.per_page}
                                                            </td>
                                                            <td>{partner.name}</td>
                                                            <td>{partner.location?.name || 'N/A'}</td>
                                                            <td>{partner.contact}</td>
                                                            <td className="text-center">
                                                                {hasAnyPermission(['location-partners.edit']) && (
                                                                    <Link 
                                                                        href={`/account/location-partners/${partner.id}/edit`} 
                                                                        className="btn btn-primary btn-sm me-2"
                                                                    >
                                                                        <i className="fa fa-pencil-alt"></i>
                                                                    </Link>
                                                                )}
                                                                {hasAnyPermission(['location-partners.delete']) && (
                                                                    <button 
                                                                        className="btn btn-danger btn-sm"
                                                                        onClick={() => handleDelete(partner.id)}
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
                                        <Pagination links={locationPartners.links} align={'end'} />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
