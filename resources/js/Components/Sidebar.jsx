//import React
import React, { useState } from "react";

//import permissions
import hasAnyPermission from '../Utils/Permissions';

//import Link and usePage
import { Link, usePage } from '@inertiajs/react';

export default function Sidebar() {
    const { url } = usePage();

    // State to toggle submenu visibility
    const [isLocationOpen, setIsLocationOpen] = useState(false);

    return (
        <>
            <div className="list-group list-group-flush">
                {hasAnyPermission(['dashboard.index']) &&
                    <Link href="/account/dashboard" className={`${url.startsWith('/account/dashboard') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}><i className="fa fa-tachometer-alt me-2"></i> Dashboard</Link>
                }

                {/* Locations with Submenu */}
                {hasAnyPermission(['locations.index']) && (
                    <>
                        <div
                            className="list-group-item list-group-item-action list-group-item-light p-3 d-flex justify-content-between align-items-center"
                            onClick={() => setIsLocationOpen(!isLocationOpen)}
                            style={{ cursor: 'pointer' }}
                        >
                            <span>
                                <i className="fa fa-map-marker-alt me-2"></i> Locations
                            </span>
                            <i className={`fa fa-chevron-${isLocationOpen ? 'down' : 'right'}`}></i>
                        </div>
                        {isLocationOpen && (
                            <div className="submenu">
                                <Link href="/account/locations/region1" className="list-group-item list-group-item-action list-group-item-light ps-5 p-2">
                                    <i className="fa fa-map-pin me-2"></i> Region 1
                                </Link>
                                <Link href="/account/locations/region2" className="list-group-item list-group-item-action list-group-item-light ps-5 p-2">
                                    <i className="fa fa-map-pin me-2"></i> Region 2
                                </Link>
                                <Link href="/account/locations/settings" className="list-group-item list-group-item-action list-group-item-light ps-5 p-2">
                                    <i className="fa fa-cog me-2"></i> Settings
                                </Link>
                            </div>
                        )}
                    </>
                )}

                {hasAnyPermission(['categories.index']) &&
                    <Link href="/account/categories" className={`${url.startsWith('/account/categories') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}><i className="fa fa-folder me-2"></i> Categories</Link>
                }

                {hasAnyPermission(['products.index']) &&
                    <Link href="/account/products" className={`${url.startsWith('/account/products') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}><i className="fa fa-shopping-bag me-2"></i> Products</Link>
                }

                {hasAnyPermission(['transactions.index']) &&
                    <Link href="/account/transactions" className={`${url.startsWith('/account/transactions') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}><i className="fa fa-shopping-cart me-2"></i> Transactions</Link>
                }

                {hasAnyPermission(['sliders.index']) &&
                    <Link href="/account/sliders" className={`${url.startsWith('/account/sliders') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}><i className="fa fa-images me-2"></i> Sliders</Link>
                }

                {hasAnyPermission(['roles.index']) &&
                    <Link href="/account/roles" className={`${url.startsWith('/account/roles') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}><i className="fa fa-shield-alt me-2"></i> Roles</Link>
                }

                {hasAnyPermission(['permissions.index']) &&
                    <Link href="/account/permissions" className={`${url.startsWith('/account/permissions') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}><i className="fa fa-key me-2"></i> Permissions</Link>
                }

                {hasAnyPermission(['users.index']) &&
                    <Link href="/account/users" className={`${url.startsWith('/account/users') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}><i className="fa fa-users me-2"></i> Users</Link>
                }
            </div>
        </>
    );
}
