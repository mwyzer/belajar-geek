import React from "react";
import hasAnyPermission from '../Utils/Permissions';
import { Link, usePage } from '@inertiajs/react';

export default function Sidebar() {
    const { url } = usePage();

    const sidebarLinks = [
        { permission: 'dashboard.index', href: '/account/dashboard', icon: 'fa-tachometer-alt', label: 'Dashboard' },
        { permission: 'colors.index', href: '/account/colors', icon: 'fa-palette', label: 'Colors' },
        { permission: 'warnas.index', href: '/account/warnas', icon: 'fa-tint', label: 'Warnas' },
        { permission: 'providerlocations.index', href: '/account/provider-locations', icon: 'fa-map-marker-alt', label: 'Provider Locations' },
        { permission: 'locations.index', href: '/account/locations', icon: 'fa-map-marker-alt', label: 'Locations' },
        // Location Partners
        { permission: 'locationpartners.index', href: '/account/location-partners', icon: 'fa-map-marker-alt', label: 'Location Partners' },
        { permission: 'categories.index', href: '/account/categories', icon: 'fa-folder', label: 'Categories' },
        { permission: 'providers.index', href: '/account/providers', icon: 'fa-folder', label: 'Providers' },
        { permission: 'vouchers.index', href: '/account/vouchers', icon: 'fa-ticket-alt', label: 'Vouchers' },
        { permission: 'customers.index', href: '/account/customers', icon: 'fa-users', label: 'Customers' },
        { permission: 'products.index', href: '/account/products', icon: 'fa-shopping-bag', label: 'Products' },
        { permission: 'transactions.index', href: '/account/transactions', icon: 'fa-shopping-cart', label: 'Transactions' },
        { permission: 'sliders.index', href: '/account/sliders', icon: 'fa-images', label: 'Sliders' },
        { permission: 'roles.index', href: '/account/roles', icon: 'fa-shield-alt', label: 'Roles' },
        { permission: 'permissions.index', href: '/account/permissions', icon: 'fa-key', label: 'Permissions' },
        { permission: 'users.index', href: '/account/users', icon: 'fa-user', label: 'Users' },
    ];

    return (
        <div className="list-group list-group-flush">
            {sidebarLinks.map(({ permission, href, icon, label }) => (
                hasAnyPermission([permission]) && (
                    <Link
                        key={permission}
                        href={href}
                        className={`${url.startsWith(href) ? "active" : ""} list-group-item list-group-item-action list-group-item-light p-3`}
                    >
                        <i className={`fa ${icon} me-2`}></i> {label}
                    </Link>
                )
            ))}
        </div>
    );
}
