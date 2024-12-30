import React, { useState } from "react";
import LayoutAccount from '../../../Layouts/Account';
import { Head, usePage, Link, router } from '@inertiajs/react';
import hasAnyPermission from '../../../Utils/Permissions';
import Search from '../../../Shared/Search';
import Pagination from '../../../Shared/Pagination';
import Sidebar2 from '../../../Components/Sidebar2';
import NewLayout from "../../../Layouts/Account2";

export default function LocationIndex() {
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const { locations } = usePage().props;

    const toggleSidebar = () => {
        setSidebarOpen(!sidebarOpen);
    };

    const handleDelete = (id) => {
        if (confirm('Are you sure you want to delete this location?')) {
            router.delete(`/account/locations/${id}`);
        }
    };

    return (
        <>
            <Head>
                <title>Locations - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="d-flex">
                    {/* Sidebar - Make it always visible on desktop */}
                    <div className="sidebar-nav d-none d-md-block" style={{
                        width: '250px',
                        minHeight: '100vh',
                        borderRight: '1px solid #dee2e6'
                    }}>
                        <NewLayout />
                    </div>

                    {/* Mobile Sidebar - Only shows when toggled */}
                    <div className={`position-fixed sidebar-nav d-md-none ${sidebarOpen ? 'd-block' : 'd-none'}`} style={{
                        width: '250px',
                        minHeight: '100vh',
                        borderRight: '1px solid #dee2e6',
                        zIndex: 1000
                    }}>
                        <Sidebar2 />
                    </div>

                    {/* Main Content - Always visible */}
                    <div className="flex-grow-1 p-4">
                        {/* Toggle Button */}
                        <button 
                            className="btn btn-primary d-md-none mb-3" 
                            onClick={toggleSidebar}
                        >
                            <i className={`fa fa-${sidebarOpen ? 'times' : 'bars'}`}></i>
                        </button>

                        {/* Rest of your content */}
                        <div className="row mt-5">
                            <div className="col-md-8">
                                <div className="row">
                                    <div className="col-md-3 col-12 mb-2">
                                        <Link 
                                            href="/account/locations/create" 
                                            className="btn btn-md btn-success border-0 shadow w-100"
                                            type="button"
                                        >
                                            <i className="fa fa-plus-circle me-2"></i>
                                            Add Location
                                        </Link>
                                    </div>
                                    <div className="col-md-9 col-12 mb-2">
                                        <Search URL={'/account/locations'} />
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
                                            <i className="fa fa-map-marker-alt"></i> Locations
                                        </span>
                                    </div>
                                    <div className="card-body">
                                        <div className="table-responsive">
                                            <table className="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style={{ width: '5%' }}>No.</th>
                                                        <th scope="col" style={{ width: '15%' }}>Location</th>
                                                        <th scope="col" style={{ width: '25%' }}>Address</th>
                                                        <th scope="col" style={{ width: '15%' }}>Image</th>
                                                        <th scope="col" style={{ width: '15%' }}>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {locations.data.map((location, index) => (
                                                        <tr key={location.id}>
                                                            <td className="text-center">
                                                                {index + 1 + (locations.current_page - 1) * locations.per_page}
                                                            </td>
                                                            <td>{location.name}</td>
                                                            <td>{location.address}</td>
                                                            <td className="text-center">
                                                                {location.image ? (
                                                                    <img 
                                                                        src={location.image} 
                                                                        alt="Location"
                                                                        className="rounded-circle"
                                                                        width="50"
                                                                        height="50"
                                                                    />
                                                                ) : (
                                                                    <span className="text-muted">No Image</span>
                                                                )}
                                                            </td>
                                                            <td className="text-center">
                                                                {hasAnyPermission(['locations.edit']) && (
                                                                    <Link 
                                                                        href={`/account/locations/${location.id}/edit`} 
                                                                        className="btn btn-primary btn-sm me-2"
                                                                    >
                                                                        <i className="fa fa-pencil-alt"></i>
                                                                    </Link>
                                                                )}
                                                                {hasAnyPermission(['locations.delete']) && (
                                                                    <button 
                                                                        className="btn btn-danger btn-sm"
                                                                        onClick={() => handleDelete(location.id)}
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
                                        <Pagination links={locations.links} align={'end'} />
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
