//import React
import React from "react";

//import permissions
import hasAnyPermission from '../Utils/Permissions';

//import Link and usePage
import { Link, usePage } from '@inertiajs/react';

export default function Sidebar() {
    const { url } = usePage();

    return (
        <>
            <div className="list-group list-group-flush">
                {hasAnyPermission(['dashboard.index']) &&
                    <Link href="/account/dashboard" className={`${url.startsWith('/account/dashboard') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-tachometer-alt me-2"></i> Dashboard
                    </Link>
                }

                {hasAnyPermission(['colors.index']) &&
                    <Link href="/account/colors" className={`${url.startsWith('/account/colors') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-map-marker-alt me-2"></i> Colors
                    </Link>
                }

                {hasAnyPermission(['warnas.index']) &&
                    <Link href="/account/warnas" className={`${url.startsWith('/account/warnas') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-map-marker-alt me-2"></i> Warnas
                    </Link>
                }

                {hasAnyPermission(['providerlocations.index']) &&
                    <Link href="/account/provider-locations" className={`${url.startsWith('/account/provider-locations') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-map-marker-alt me-2"></i> Provider Locations
                    </Link>
                }

                {hasAnyPermission(['locations.index']) &&
                    <Link href="/account/locations" className={`${url.startsWith('/account/locations') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-map-marker-alt me-2"></i> Locations
                    </Link>
                }

                {hasAnyPermission(['categories.index']) &&
                    <Link href="/account/categories" className={`${url.startsWith('/account/categories') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-folder me-2"></i> Categories
                    </Link>
                }

                {hasAnyPermission(['providers.index']) &&
                    <Link href="/account/providers" className={`${url.startsWith('/account/providers') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-folder me-2"></i> Providers
                    </Link>
                }

                {hasAnyPermission(['vouchers.index']) &&
                    <Link href="/account/vouchers" className={`${url.startsWith('/account/vouchers') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-folder me-2"></i> Vouchers
                    </Link>
                }

                {hasAnyPermission(['customers.index']) &&
                    <Link href="/account/customers" className={`${url.startsWith('/account/customers') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-users me-2"></i> Customers
                    </Link>
                }

                {hasAnyPermission(['products.index']) &&
                    <Link href="/account/products" className={`${url.startsWith('/account/products') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-shopping-bag me-2"></i> Products
                    </Link>
                }

                {hasAnyPermission(['transactions.index']) &&
                    <Link href="/account/transactions" className={`${url.startsWith('/account/transactions') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-shopping-cart me-2"></i> Transactions
                    </Link>
                }

                {hasAnyPermission(['sliders.index']) &&
                    <Link href="/account/sliders" className={`${url.startsWith('/account/sliders') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-images me-2"></i> Sliders
                    </Link>
                }

                {hasAnyPermission(['roles.index']) &&
                    <Link href="/account/roles" className={`${url.startsWith('/account/roles') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-shield-alt me-2"></i> Roles
                    </Link>
                }

                {hasAnyPermission(['permissions.index']) &&
                    <Link href="/account/permissions" className={`${url.startsWith('/account/permissions') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-key me-2"></i> Permissions
                    </Link>
                }

                {hasAnyPermission(['users.index']) &&
                    <Link href="/account/users" className={`${url.startsWith('/account/users') ? "active list-group-item list-group-item-action list-group-item-light p-3" : "list-group-item list-group-item-action list-group-item-light p-3"}`}>
                        <i className="fa fa-users me-2"></i> Users
                    </Link>
                }
            </div>
        </>
    );
}
